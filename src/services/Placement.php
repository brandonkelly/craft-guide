<?php
/**
 * Guide plugin for Craft CMS 3.x
 *
 * A CMS Guide for Craft CMS.
 *
 * @link      https://wbrowar.com
 * @copyright Copyright (c) 2021 Will Browar
 */

namespace wbrowar\guide\services;

use Craft;
use craft\base\Component;
use craft\elements\User;
use craft\helpers\Json;
use wbrowar\guide\Guide;
use wbrowar\guide\models\Placement as PlacementModel;
use wbrowar\guide\records\Placements;

/**
 * @author    Will Browar
 * @package   Guide
 * @since     3.0.0
 */
class Placement extends Component
{
    // Public Methods
    // =========================================================================

    // todo Add functions:
    // todo getGuidesForPlacement - after getting placement data, query guides
    // todo getPlacementsForGroup - get all placements for a group, like nav, section, etc ...
    // todo getPlacementsForUri - get all placements for a specific URI

    /**
     * Get all group information for the Organizer
     *
     * @return mixed
     */
    public function getPlacementGroups(): mixed
    {
        $colLg = 3;
        $colMd = 2;
        $colSm = 1;
        $headerLg = 3;
        $headerMd = 2;
        $headerSm = 1;

//        $groups = [[
//            'columns' => $colLg,
//            'description' => 'The Guide CP Section',
//            'header' => 'Guide',
//            'headerSize' => $headerLg,
//            'label' => 'Guide',
//            'name' => 'nav',
//            'groupId' => null,
//        ]];
        
        if (Guide::$pro) {
            // Assets and asset volumes - if any
            $assetVolumes = Craft::$app->getVolumes()->getAllVolumes();

            if ($assetVolumes ?? false) {
                $groups[] = [
                    'columns' => $colSm,
                    'description' => 'All asset edit pages',
                    'header' => 'Assets',
                    'headerSize' => $headerMd,
                    'label' => 'Assets',
                    'name' => 'asset',
                    'groupId' => null,
                ];

                foreach ($assetVolumes as $item) {
                    $groups[] = [
                        'columns' => $colSm,
                        'description' => 'Assets in the ' . $item->name . ' volume',
                        'header' => $item->name,
                        'label' => 'Asset Volumes',
                        'headerSize' => $headerSm,
                        'name' => 'assetVolume',
                        'groupId' => intval($item->id),
                    ];
                }
            }

            // Categories and category groups - if any
            $categoryGroups = Craft::$app->getCategories()->getAllGroups();

            if ($categoryGroups ?? false) {
                $groups[] = [
                    'columns' => $colSm,
                    'description' => 'All category edit pages',
                    'header' => 'Categories',
                    'headerSize' => $headerMd,
                    'label' => 'Categories',
                    'name' => 'category',
                    'groupId' => null,
                ];

                foreach ($categoryGroups as $item) {
                    $groups[] = [
                        'columns' => $colSm,
                        'description' => 'Categories in the ' . $item->name . ' group',
                        'header' => $item->name,
                        'headerSize' => $headerSm,
                        'label' => 'Category Groups',
                        'name' => 'categoryGroup',
                        'groupId' => intval($item->id),
                    ];
                }
            }

            // Entries and sections - if any
            $sections = Craft::$app->getSections()->getAllSections();

            if ($sections ?? false) {
                $groups[] = [
                    'columns' => $colSm,
                    'description' => 'All entry edit pages',
                    'header' => 'Entries',
                    'headerSize' => $headerMd,
                    'label' => 'Entries',
                    'name' => 'entry',
                    'groupId' => null,
                ];

                foreach ($sections as $section) {
                    $groups[] = [
                        'columns' => $colSm,
                        'description' => 'Entries in the ' . $section->name . ' section',
                        'header' => $section->name,
                        'headerSize' => $headerSm,
                        'label' => 'Sections',
                        'name' => 'section',
                        'groupId' => intval($section->id),
                    ];
                }
            }

            // Entries and sections - if any
            $globalSets = Craft::$app->getGlobals()->getAllSets();

            if ($globalSets ?? false) {
                $groups[] = [
                    'columns' => $colSm,
                    'description' => 'All globals edit pages',
                    'header' => 'Globals',
                    'headerSize' => $headerMd,
                    'label' => 'Globals',
                    'name' => 'global',
                    'groupId' => null,
                ];

                foreach ($globalSets as $globalSet) {
                    $groups[] = [
                        'columns' => $colSm,
                        'description' => $globalSet->name . 'global edit pages',
                        'header' => $globalSet->name,
                        'headerSize' => $headerSm,
                        'label' => 'Global Sets',
                        'name' => 'globalSet',
                        'groupId' => intval($globalSet->id),
                    ];
                }
            }

            // Users
            $groups[] = [
                'columns' => $colSm,
                'description' => 'All user edit pages',
                'header' => 'Users',
                'headerSize' => $headerMd,
                'label' => 'Users',
                'name' => 'user',
                'groupId' => null,
            ];

            // Widgets
            $groups[] = [
                'columns' => $colMd,
                'description' => 'User created widgets',
                'header' => 'Widgets',
                'headerSize' => $headerMd,
                'label' => 'Widgets',
                'name' => 'widget',
                'groupId' => null,
            ];

            // UI Elements
//            $groups[] = [
//                'columns' => $colMd,
//                'description' => 'Guides added to UI Elements',
//                'header' => 'UI Elements',
//                'headerSize' => $headerMd,
//                'label' => 'UI Elements',
//                'name' => 'uiElement',
//                'groupId' => null,
//            ];

            // URIs
//            $groups[] = [
//                'columns' => $colLg,
//                'description' => 'Individual pages in the CP',
//                'header' => 'Control Panel Pages',
//                'headerSize' => $headerLg,
//                'label' => 'Control Panel Pages',
//                'name' => 'uri',
//                'groupId' => null,
//            ];
        }

        return $groups;
    }

    /**
     * Query guide placements for the Organizer
     *
     * @return Placements | null
     */
    public function getPlacements(array $params = [], string $queryType = 'all')
    {
        if (Guide::$pro) {
            if ($params['limit'] ?? false) {
                $limit = $params['limit'];
                unset($params['limit']);
            } else {
                $limit = null;
            }

            if ($params['orderBy'] ?? false) {
                $orderBy = $params['orderBy'];
                unset($params['orderBy']);
            } else {
                $orderBy = 'id';
            }

            switch ($queryType) {
                case 'all':
                    $placements = Placements::find()->where($params)->limit($limit)->orderBy($orderBy)->all();
                    break;
                case 'new':
                    $placements = new Placements([]);
                    break;
                case 'one':
                    $placements = Placements::find()->where($params)->orderBy($orderBy)->one();
                    break;
                case 'count':
                    $placements = Placements::find()->where($params)->count();
                    break;
                case 'ids':
                    $placements = Placements::find()->where($params)->ids();
                    break;
                case 'guideId':
                    $placements = Placements::find()->where($params)->select(['guideId'])->all();
                    break;
            }
        }

        return $placements ?? null;
    }

    /*
     * @return mixed
     */
    public function savePlacement(PlacementModel $model, int $id = null):int
    {
        if ($id ?? false) {
            $record = Placements::findOne(['id' => $id]);
        } else {
            $record = new Placements();
        }

        // todo remove beginning / and cpTrigger from URI

        $record->access = $model->access;
        $record->group = $model->group;
        $record->groupId = $model->groupId;
        $record->guideId = $model->guideId;
        $record->portalMethod = $model->portalMethod;
        $record->selector = $model->selector;
        $record->uri = $model->uri;

        $record->save();

        return $record->id;
    }
}
