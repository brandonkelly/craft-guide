(window.webpackJsonp=window.webpackJsonp||[]).push([[10],{12:function(e,t,o){"use strict";o.r(t);var s=o(21),a={data:function(){return{coverStyles:{},pageStyles:{}}},props:{assetPath:{required:!0}},created:function(){this.coverStyles={backgroundImage:"url(".concat(this.assetPath,"/icon/welcome-cover.svg)")},this.pageStyles={backgroundImage:"url(".concat(this.assetPath,"/img/welcome-thank-you.png)")}},mounted:function(){window.onload=function(){var e=new s.a.timeline;e.to(".c_welcome_message",{duration:1.8,"--x":30,"--y":20,"--rotate-x":11,ease:"power4.out"}),e.to(".c_welcome_message__page",{duration:1.6,z:5},"-=1.6"),e.to(".c_welcome_message__page_loose",{duration:1.6,x:12,y:2,z:3,rotationZ:7,ease:"expo"},"-=1"),e.to(".c_welcome_message__page_form",{duration:2,x:20,y:5,z:20,rotationZ:-5,ease:"expo"},"-=2"),e.to(".c_welcome_message__cover",{duration:.4,rotationY:-140,transformOrigin:"left",ease:"none"}),e.to(".c_welcome_message__cover_back",{duration:.4,rotationY:40,z:1,transformOrigin:"right",ease:"none"},"-=".concat(.4)),e.to(".c_welcome_message__cover_back__edge",{duration:.4,rotationY:41,z:1,transformOrigin:"right",ease:"none"},"-=".concat(.4)),e.to(".c_welcome_message",{duration:1.7,"--x":-200,"--rotate-x":-6,ease:"expo"},"-=0.3"),e.to(".c_welcome_message__page_form",{delay:.2,duration:1.7,"--shadow":1.3,x:210,y:24,z:20,scale:1.1,rotationZ:10,ease:"expo"},"-=1.9")}}},n=o(13),c=Object(n.a)(a,(function(){var e=this,t=e.$createElement,o=e._self._c||t;return o("div",{staticClass:"c_welcome_message"},[o("div",{staticClass:"c_welcome_message__guide"},[o("div",{staticClass:"c_welcome_message__back"}),e._v(" "),o("div",{staticClass:"c_welcome_message__page_loose"}),e._v(" "),o("div",{staticClass:"c_welcome_message__page",style:e.pageStyles}),e._v(" "),o("div",{staticClass:"c_welcome_message__page_form"},[e._t("default")],2),e._v(" "),o("div",{staticClass:"c_welcome_message__cover_back"}),e._v(" "),o("div",{staticClass:"c_welcome_message__cover_back__edge"}),e._v(" "),o("div",{staticClass:"c_welcome_message__cover",style:e.coverStyles})])])}),[],!1,null,null,null);t.default=c.exports},13:function(e,t,o){"use strict";function s(e,t,o,s,a,n,c,_){var r,i="function"==typeof e?e.options:e;if(t&&(i.render=t,i.staticRenderFns=o,i._compiled=!0),s&&(i.functional=!0),n&&(i._scopeId="data-v-"+n),c?(r=function(e){(e=e||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(e=__VUE_SSR_CONTEXT__),a&&a.call(this,e),e&&e._registeredComponents&&e._registeredComponents.add(c)},i._ssrRegister=r):a&&(r=_?function(){a.call(this,(i.functional?this.parent:this).$root.$options.shadowRoot)}:a),r)if(i.functional){i._injectStyles=r;var l=i.render;i.render=function(e,t){return r.call(t),l(e,t)}}else{var d=i.beforeCreate;i.beforeCreate=d?[].concat(d,r):[r]}return{exports:e,options:i}}o.d(t,"a",(function(){return s}))}}]);