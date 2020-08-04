(window.webpackJsonp=window.webpackJsonp||[]).push([[4],{10:function(t,e,a){"use strict";a.r(e);var s=a(1),i=a(2);a(22);let r=!1;function n(t){const e=t.getBoundingClientRect();return e.top>=0&&e.left>=0&&e.bottom<=(window.innerHeight||document.documentElement.clientHeight)&&e.right<=(window.innerWidth||document.documentElement.clientWidth)}function l(t,e=!1,a=!1){let s=!1;if(""!==t.getAttribute("data-lazy-animate")&&r){let e=JSON.parse(t.getAttribute("data-lazy-animate"))||{};const n=e.anim||!1,l=e.targets?document.querySelectorAll(e.targets):e.target?document.querySelector(e.target):t;s=e.reset||!1,a&&(e.staticOnLoad,1)&&(e.delay=e.speed=0),n?requestAnimationFrame(()=>r.animate(n,l,e)):Object(i.e)("Animation function not passed in:",n)}Object(i.a)(t,"c_animate--animated"),s||(t.removeAttribute("data-lazy-animate"),e&&e.unobserve(t))}function o(t,e){if(t.hasAttribute("data-srcset")){const e=t.getAttribute("data-srcset");t.setAttribute("srcset",e),(a=t).style.paddingTop="",a.style.maxWidth="",t.removeAttribute("data-srcset"),Object(i.c)("Lazy srcset",e)}var a;if(t.hasAttribute("data-src")){const e=t.getAttribute("data-src");t.setAttribute("src",e),t.removeAttribute("data-src"),Object(i.c)("Lazy src",e)}t.removeAttribute("data-lazy-load"),null!==e&&e.unobserve(t)}class c{constructor(t={}){this.animateMargin=t.animateMargin||"-100px",this.animateThreshold=t.animateThreshold||0,this.loadMargin=t.loadMargin||"50%",this.loadThreshold=t.loadThreshold||0,this.createImagePlaceholders(),this.loadElements=t.loadElements||document.querySelectorAll("[data-lazy-load]"),this.loadElements.length>0&&(this.loadObserver=new IntersectionObserver(t=>{t.forEach(t=>{Object(i.c)("Lazy loading element",t),t.isIntersecting&&o(t.target,this.loadObserver)})},{rootMargin:this.loadMargin,threshold:this.loadThreshold}),this.loadElements.forEach(t=>{n(t)?o(t,null):this.loadObserver.observe(t)})),this.animateElements=t.animateElements||document.querySelectorAll("[data-lazy-animate]"),this.animateElements.length>0&&Promise.all([a.e(0),a.e(2)]).then(a.bind(null,36)).then(t=>{r=t,this.animateObserver=new IntersectionObserver(t=>{t.forEach(t=>{Object(i.c)("Lazy animating element",t),t.isIntersecting&&l(t.target,this.animateObserver)})},{rootMargin:this.animateMargin,threshold:this.animateThreshold}),this.animateElements.forEach(t=>{let e=JSON.parse(t.getAttribute("data-lazy-animate"))||{};n(t)?l(t,e.reset?this.animateObserver:null,!0):this.animateObserver.observe(t)})}).catch(t=>Object(i.e)("An error occurred while loading the component"))}createImagePlaceholders(){const t=document.querySelectorAll("img[data-lazy-load]");Array.prototype.forEach.call(t,(function(t,e){if(t.getAttribute("data-width")&&t.getAttribute("data-height")){const e=t.getAttribute("data-width"),a=t.getAttribute("data-height");t.style.paddingTop=a/e*100+"%",t.style.maxWidth=t.getAttribute("data-width")+"px"}}))}updateAnimate(t=!1){(t?document.querySelectorAll(t+" [data-lazy-animate],"+t+"[data-lazy-animate]"):this.animateElements).forEach(e=>{t?l(e,null,r):n(e)?l(e,this.animateObserver,r):this.loadObserver.observe(e)})}updateLoad(t=!1){(t?document.querySelectorAll(t+" [data-lazy-load],"+t+"[data-lazy-load]"):this.loadElements).forEach(e=>{t?o(e,null):n(e)?o(e,this.loadObserver):this.loadObserver.observe(e)})}}Object(i.c)("Lazy Loading");var d=a(16),h={data:()=>({currentSize:{},sizes:{}}),props:{mqSizes:{required:!0},rootClass:{default:""}},computed:{wrapperClasses:function(){let t=[];return this.currentSize.classes&&this.currentSize.classes.forEach(e=>{t.push(this.rootClass+"--"+e)}),t},wrapperStyles:function(){let t={};return this.currentSize.styles&&(t=this.currentSize.styles),t}},methods:{},created(){this.sizes=JSON.parse(this.mqSizes)},mounted(){new d.a(t=>{for(let e of t){const{left:t,top:a,width:s,height:i}=e.contentRect;this.currentSize={},this.sizes.forEach(t=>{s>=t.width&&(this.currentSize=t)})}}).observe(this.$el)}},u=a(13),m={components:{ResizeContainer:Object(u.a)(h,(function(){var t=this.$createElement;return(this._self._c||t)("div",{staticClass:"c_resize_container",class:this.wrapperClasses,style:this.wrapperStyles},[this._t("default")],2)}),[],!1,null,null,null).exports},props:{gridType:!1},computed:{mqSizes:function(){let t=[];switch(this.gridType){case"2-column":t.push({width:650,styles:{gridTemplateColumns:"1fr 1fr"}});break;case"3-column":t.push({width:650,styles:{gridTemplateColumns:"1fr 1fr 1fr"}});break;case"4-column":t.push({width:650,styles:{gridTemplateColumns:"1fr 1fr"}},{width:800,styles:{gridTemplateColumns:"1fr 1fr 1fr 1fr"}});break;case"text-sidebar":t.push({width:650,styles:{alignItems:"center",gridTemplateColumns:"minmax(400px, var(--max-width-text)) minmax(200px, 400px)"}});break;case"sidebar-text":t.push({width:650,styles:{alignItems:"center",gridTemplateColumns:"minmax(200px, 400px) minmax(400px, var(--max-width-text))"}})}return JSON.stringify(t)}}},g=(a(23),Object(u.a)(m,(function(){var t=this.$createElement,e=this._self._c||t;return this.mqSizes?e("resize-container",{staticClass:"c_grid",attrs:{"mq-sizes":this.mqSizes}},[this._t("default")],2):this._e()}),[],!1,null,null,null).exports);let p=new s.a;const b=document.querySelector("[data-guide-page-nav]");b&&new s.a({el:b,components:{},delimiters:["${","}"],data:()=>({nav:[]}),computed:{},methods:{navItemClicked:function(t){const e=document.querySelector("html");if("first"===t)e.scrollTop=0;else{const a=e.querySelector('[data-guide-section="'+t+'"]');e.scrollTop=a.offsetTop+60}}},created(){Object(i.c)("Guide Page Nav"),p.$on("guide-content-sections-updated",t=>{this.nav=t})}});document.querySelectorAll("[data-guide-content]").forEach(t=>{new s.a({el:t,components:{Grid:g},delimiters:["${","}"],data:()=>({sections:[]}),computed:{},methods:{},mounted(){Object(i.c)("Guide Content");this.$el.querySelectorAll("h1, h2, h3, h4, h5, h6").forEach(t=>{const e=t.innerText,a=Object(i.d)(e.substr(0,40));t.setAttribute("data-guide-section",a);let s=3;"H1"===t.nodeName?s=1:"H2"===t.nodeName&&(s=2),this.sections.push({level:s,title:e,slug:a})}),this.sections.length>0&&p.$emit("guide-content-sections-updated",this.sections),window.lazy=new c({container:this.$el})},$nextTick(){}})})},14:function(t,e,a){var s=a(24);"string"==typeof s&&(s=[[t.i,s,""]]),s.locals&&(t.exports=s.locals);(0,a(35).default)("7622e594",s,!0,{})},23:function(t,e,a){"use strict";var s=a(14);a.n(s).a},24:function(t,e,a){(e=a(25)(!1)).push([t.i,".c_grid{display:grid;grid-template-columns:1fr;grid-template-rows:auto;grid-gap:var(--grid-gap);margin:2.4rem 0}h1+.c_grid,h2+.c_grid,h3+.c_grid,h4+.c_grid,h5+.c_grid,h6+.c_grid{margin-top:0}.c_grid:last-child{margin-bottom:0}\n",""]),t.exports=e}}]);