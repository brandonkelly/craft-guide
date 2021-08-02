<?php
/**
 * Guide plugin for Craft CMS 3.x
 *
 * A CMS Guide for Craft CMS.
 *
 * @link      https://wbrowar.com
 * @copyright Copyright (c) 2019 Will Browar
 */

namespace wbrowar\guide\controllers;

use craft\helpers\Assets;
use craft\helpers\FileHelper;
use craft\helpers\Json;
use craft\web\View;
use wbrowar\guide\Guide;
use wbrowar\guide\models\Guide as GuideModel;

use Craft;
use craft\web\Controller;
use wbrowar\guide\models\Placement as PlacementModel;

/**
 * @author    Will Browar
 * @package   Guide
 * @since     2.0.0
 */
class ImportExportController extends Controller
{

    // Protected Properties
    // =========================================================================

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     *         The actions must be in 'kebab-case'
     * @access protected
     */
//    protected $allowAnonymous = ['index', 'do-something'];

    // Public Methods
    // =========================================================================

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        return null;
    }

    /**
     * Downloads all tempaltes from https://github.com/wbrowar/craft-guide-templates and unzips them all to runtime directory.
     *
     * actions/guide/import-export/download-templates
     *
     * @return mixed
     */
    // todo delete this
    public function actionDownloadTemplates()
    {
        $params = Craft::$app->getRequest()->getBodyParams();

        $selectedBranch = $params['branch'] ?? 'master';
        $branch = [
            'dev' => [
                'unzippedDir' => '/craft-guide-templates-dev',
                'zip' => 'https://github.com/wbrowar/craft-guide-templates/archive/dev.zip',
            ],
            'master' => [
                'unzippedDir' => '/craft-guide-templates-master',
                'zip' => 'https://github.com/wbrowar/craft-guide-templates/archive/master.zip',
            ]
        ];

        $results = [
            'guides' => [],
            'status' => 'error',
            'error' => '',
        ];

        $filePath = Craft::$app->getRuntimePath() . "/guide-templates";
        $fileName = $filePath . "/templates.zip";
        
        if (FileHelper::isWritable($filePath)) {
            FileHelper::createDirectory($filePath);
        }

        $fileDownloaded =  file_put_contents($fileName, file_get_contents($branch[$selectedBranch]['zip']));
        if ($fileDownloaded) {
            $zip = new \ZipArchive();
            $checkFile = $zip->open($fileName);
            if ($checkFile === TRUE) {
                // extract it to the path we determined above
                $zip->extractTo($filePath);
                $zip->close();
            } else {
                $results['error'] = 'Couldn’t open downloaded template files';
                return $this->asJson($results);
            }
        } else {
            $results['error'] = 'Couldn’t download template files';
            return $this->asJson($results);
        }

        $unzippedDirectory = $filePath . $branch[$selectedBranch]['unzippedDir'];
        $guidesInfoFileJson = file_get_contents($unzippedDirectory . "/guides.json");
        if ($guidesInfoFileJson) {
            $guidesInfoFile = Json::decode($guidesInfoFileJson);
            
            if ($guidesInfoFile ?? false) {
                foreach ($guidesInfoFile['guides'] as $guide) {
                    if ($guide['path'] ?? false) {
                        $infoData = file_get_contents($unzippedDirectory . "/" . $guide['path'] . "/info.json");

                        if ($infoData ?? false) {
                            $info = Json::decode($infoData);

                            if ($info ?? false && $info['templatesPath'] ?? false) {
                                $info['unzippedPath'] = $unzippedDirectory;
                                $results['guides'][] = $info;
                            }
                        }
                    }
                }
            }
        } else {
            $results['error'] = 'Couldn’t get list of available guides';
            return $this->asJson($results);
        }

        if (count($results['guides']) > 0) {
            $results['status'] = 'success';
        }

        return $this->asJson($results);
    }

    /**
     * Installs a downloaded template by importing its templates and navigation info into Guide.
     *
     * actions/guide/import-export/import-json
     *
     * @return mixed
     */
    public function actionImportJson()
    {
        $params = Craft::$app->getRequest()->getBodyParams();
        $results = [
            'completed' => [],
            'status' => 'error',
            'error' => '',
        ];

        if ($params['guideData'] ?? false) {
            $guideData = Json::decodeIfJson($params['guideData']);

            // Import guides
            if ($guideData['guides'] ?? false) {
                foreach ($guideData['guides'] as $item) {
                    Guide::$plugin->importExport->importGuideData($item);
                }

                $results['status'] = 'success';
            }

            // todo change this to placements
            // Import Guide CP navigation
//            if ($guideData['cpNav'] ?? false) {
//                $guideSlugs = [];
//                $organizer = Guide::$plugin->organizer->getOrganizer()->toArray();
//                $organizerId = $organizer['id'];
//                $guides = Guide::$plugin->guide->getGuides();
//
//                foreach ($guides as $guide) {
//                    $guideSlugs[$guide['slug']] = $guide['id'];
//                }
//
//                $cpNav = [];
//                foreach ($guideData['cpNav'] as $item) {
//                    $cpNav[] = strval($guideSlugs[$item]);
//                }
//                $newOrganizer = new Placement([
//                    'cpNav' => Json::encode($cpNav)
//                ]);
//
//                Guide::$plugin->organizer->saveOrganizer($newOrganizer, $organizerId);
//            }
        }

        return $this->asJson($results);
    }

    /**
     * Installs a downloaded template by importing its templates and navigation info into Guide.
     *
     * actions/guide/import-export/import-template
     *
     * @return mixed
     */
    public function actionImportTemplate()
    {
        $params = Craft::$app->getRequest()->getBodyParams();
        $template = $params['template'];
        $results = [
            'completed' => [],
            'status' => 'error',
            'error' => '',
        ];

        $settings = Guide::$settings;

        if ($template['unzippedPath'] ?? false) {
            // Copy files to user template folder
            if ($params['enableImportTemplates'] == 'true' && $settings->templatePath ?? false && $template['templatesPath'] ?? false) {
                $templatesPath = $template['unzippedPath'] . '/' . $template['templatesPath'];

                $oldMode = Craft::$app->getView()->getTemplateMode();
                Craft::$app->getView()->setTemplateMode(View::TEMPLATE_MODE_SITE);
                $userTemplatePath = Craft::$app->getView()->getTemplatesPath() . '/' . $settings->templatePath;

                if (is_dir($templatesPath) ?? false && is_dir($userTemplatePath) ?? false) {
                    FileHelper::copyDirectory($templatesPath, $userTemplatePath);
                }

                Craft::$app->getView()->setTemplateMode($oldMode);
                
                $results['completed'][] = 'Imported templates into ' . $userTemplatePath;
            }
            
            // Copy assets and update asset index
            if ($params['enableImportAssets'] == 'true' && $settings->assetVolume ?? false && $template['assetsPath'] ?? false) {
                $assetsPath = $template['unzippedPath'] . '/' . $template['assetsPath'];
                $assetsVolume = Craft::$app->getVolumes()->getVolumeByUid($settings->assetVolume);
                $assetFolderPath = $assetsVolume->rootPath;

                // Copy files into volume
                if (is_dir($assetsPath) ?? false && is_dir($assetFolderPath) ?? false) {
                    FileHelper::copyDirectory($assetsPath, $assetFolderPath);
                }

                // Index new files to add them to the asset volume index
                $assetIndexer = Craft::$app->getAssetIndexer();
                $session = $assetIndexer->getIndexingSessionId();

                $fileList = array_filter($assetIndexer->getIndexListOnVolume($assetsVolume, ''),
                    function ($entry) {
                        return $entry['type'] !== 'dir';
                    }
                );
                
                $startAt = 0;
                $index = 0;
                foreach ($fileList as $item) {
                    if ($index++ < $startAt) {
                        continue;
                    }
                    try {
                        $assetIndexer->indexFile($assetsVolume, $item['path'], $session, false);
                    } catch (\Throwable $e) {
                        Craft::$app->getErrorHandler()->logException($e);
                    }
                }

                $results['completed'][] = 'Imported assets into ' . $assetsVolume->name . ' asset volume.';
            }

            // Add to guide navigation
            if ($params['enableImportGuides'] == 'true' && $template['guides'] ?? false) {
                foreach ($template['guides'] as $item) {
                    Guide::$plugin->importExport->importGuideData($item);
                }
                $results['completed'][] = 'Imported guides into Placement.';
            }
        }

        if (count($results['completed']) > 0) {
            $results['status'] = 'success';
        }

        return $this->asJson($results);
    }
}
