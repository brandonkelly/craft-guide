(window.webpackJsonp=window.webpackJsonp||[]).push([[10],{12:function(e,t,s){"use strict";s.r(t);var a=s(2),o=s(23),c=s(15),_={data:()=>({coverStyles:{},pageStyles:{}}),props:{assetPath:{required:!0}},methods:{},created(){this.coverStyles={backgroundImage:"url(".concat(this.assetPath,"/icon/welcome-cover.svg)")},this.pageStyles={backgroundImage:"url(".concat(this.assetPath,"/img/welcome-paper.png)")}},mounted(){const e=new c.a;let t=0;e.to(".c_welcome_message",1.6,{"--x":30,"--y":20,"--rotate-x":11,ease:o.a.easeOut}),e.to(".c_welcome_message__page_loose",1.6,{x:12,y:2,rotationZ:7,ease:o.a.easeOut},"-=1"),e.to(".c_welcome_message__page_form",1.7,{x:20,y:5,rotationZ:-5,ease:o.a.easeOut},"-=1.7"),e.to("",.3,{}),t=.4,e.to(".c_welcome_message__cover",.4,{rotationY:-140,transformOrigin:"left",ease:o.b.easeOut}),e.to(".c_welcome_message__cover_back",.4,{rotationY:40,z:1,transformOrigin:"right",ease:o.b.easeOut},"-=".concat(.4)),e.to(".c_welcome_message__cover_back__edge",.4,{rotationY:41,z:-1,transformOrigin:"right",ease:o.b.easeOut},"-=".concat(.4)),e.to(".c_welcome_message",2.7,{"--x":-270,"--rotate-x":7,ease:o.a.easeOut},"-=0.3"),e.to(".c_welcome_message__page_form",1.7,{x:300,y:-2,rotationZ:-1,ease:o.a.easeOut},"-=1.9"),e.to("",5,{}),e.call(()=>{Object(a.c)("we did it!")})}},r=s(14),n=Object(r.a)(_,function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("div",{staticClass:"c_welcome_message"},[s("div",{staticClass:"c_welcome_message__guide"},[s("div",{staticClass:"c_welcome_message__back"}),e._v(" "),s("div",{staticClass:"c_welcome_message__page_form"},[e._t("default")],2),e._v(" "),s("div",{staticClass:"c_welcome_message__page_loose"}),e._v(" "),s("div",{staticClass:"c_welcome_message__page",style:e.pageStyles}),e._v(" "),s("div",{staticClass:"c_welcome_message__cover_back"}),e._v(" "),s("div",{staticClass:"c_welcome_message__cover_back__edge"}),e._v(" "),s("div",{staticClass:"c_welcome_message__cover",style:e.coverStyles})])])},[],!1,null,null,null);t.default=n.exports},14:function(e,t,s){"use strict";function a(e,t,s,a,o,c,_,r){var n,i="function"==typeof e?e.options:e;if(t&&(i.render=t,i.staticRenderFns=s,i._compiled=!0),a&&(i.functional=!0),c&&(i._scopeId="data-v-"+c),_?(n=function(e){(e=e||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(e=__VUE_SSR_CONTEXT__),o&&o.call(this,e),e&&e._registeredComponents&&e._registeredComponents.add(_)},i._ssrRegister=n):o&&(n=r?function(){o.call(this,this.$root.$options.shadowRoot)}:o),n)if(i.functional){i._injectStyles=n;var l=i.render;i.render=function(e,t){return n.call(t),l(e,t)}}else{var m=i.beforeCreate;i.beforeCreate=m?[].concat(m,n):[n]}return{exports:e,options:i}}s.d(t,"a",function(){return a})}}]);