(window.webpackJsonp=window.webpackJsonp||[]).push([[159],{1225:function(t,n,e){"use strict";e(646)},1226:function(t,n,e){(n=e(22)(!1)).push([t.i,".misc-wrapper {\n  display: flex;\n  flex-basis: 100%;\n  min-height: 100vh;\n  width: 100%;\n  align-items: center;\n  justify-content: center;\n}\n.misc-wrapper .misc-inner {\n  position: relative;\n  max-width: 750px;\n}\n.misc-wrapper .brand-logo {\n  display: flex;\n  justify-content: center;\n  position: absolute;\n  top: 2rem;\n}\n[dir] .misc-wrapper .brand-logo {\n  margin: 0;\n}\n[dir=ltr] .misc-wrapper .brand-logo {\n  left: 2rem;\n}\n[dir=rtl] .misc-wrapper .brand-logo {\n  right: 2rem;\n}\n.misc-wrapper .brand-logo .brand-text {\n  font-weight: 600;\n}\n@media (max-height: 625px) {\n[dir] .misc-wrapper .misc-inner {\n    margin-top: 4rem;\n}\n}\n.brand-logo svg {\n  height: 28px;\n  width: 40.95px;\n}",""]),t.exports=n},1519:function(t,n,e){"use strict";e.r(n);var r=e(57),i=e(87),s=e(216),a=e(52),c=e(14),o={components:{VuexyLogo:a.a,BLink:r.a,BButton:i.a,BImg:s.a},data:function(){return{downImg:e(573)}},computed:{imgUrl:function(){return"dark"===c.a.state.appConfig.layout.skin?(this.downImg=e(574),this.downImg):this.downImg}}},l=(e(1225),e(0)),u=Object(l.a)(o,(function(){var t=this,n=t.$createElement,e=t._self._c||n;return e("div",{staticClass:"misc-wrapper"},[e("b-link",{staticClass:"brand-logo"},[e("vuexy-logo"),t._v(" "),e("h2",{staticClass:"brand-text text-primary ml-1"},[t._v("\n        Vuexy\n      ")])],1),t._v(" "),e("div",{staticClass:"misc-inner p-2 p-sm-3"},[e("div",{staticClass:"w-100 text-center"},[e("h2",{staticClass:"mb-1"},[t._v("\n          Page Not Found 🕵🏻‍♀️\n        ")]),t._v(" "),e("p",{staticClass:"mb-2"},[t._v("\n          Oops! 😖 The requested URL was not found on this server.\n        ")]),t._v(" "),e("b-button",{staticClass:"mb-2 btn-sm-block",attrs:{variant:"primary",to:{path:"/"}}},[t._v("\n          Back to home\n        ")]),t._v(" "),e("b-img",{attrs:{fluid:"",src:t.imgUrl,alt:"Error page"}})],1)])],1)}),[],!1,null,null,null);n.default=u.exports},216:function(t,n,e){"use strict";e.d(n,"b",(function(){return h})),e.d(n,"a",(function(){return f}));var r=e(16),i=e.n(r),s=e(47),a=e(5),c=e(2),o=e(23),l=e(35),u=e(7),p=e(21),b=e(1),d=e(28);function g(t,n,e){return n in t?Object.defineProperty(t,n,{value:e,enumerable:!0,configurable:!0,writable:!0}):t[n]=e,t}var m='<svg width="%{w}" height="%{h}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 %{w} %{h}" preserveAspectRatio="none"><rect width="100%" height="100%" style="fill:%{f};"></rect></svg>',h=Object(b.d)({alt:Object(b.c)(c.u),blank:Object(b.c)(c.g,!1),blankColor:Object(b.c)(c.u,"transparent"),block:Object(b.c)(c.g,!1),center:Object(b.c)(c.g,!1),fluid:Object(b.c)(c.g,!1),fluidGrow:Object(b.c)(c.g,!1),height:Object(b.c)(c.p),left:Object(b.c)(c.g,!1),right:Object(b.c)(c.g,!1),rounded:Object(b.c)(c.j,!1),sizes:Object(b.c)(c.f),src:Object(b.c)(c.u),srcset:Object(b.c)(c.f),thumbnail:Object(b.c)(c.g,!1),width:Object(b.c)(c.p)},a.kb),f=i.a.extend({name:a.kb,functional:!0,props:h,render:function(t,n){var e,r=n.props,i=n.data,a=r.alt,c=r.src,b=r.block,h=r.fluidGrow,f=r.rounded,w=Object(p.c)(r.width)||null,v=Object(p.c)(r.height)||null,j=null,O=Object(o.b)(r.srcset).filter(l.a).join(","),x=Object(o.b)(r.sizes).filter(l.a).join(",");return r.blank&&(!v&&w?v=w:!w&&v&&(w=v),w||v||(w=1,v=1),c=function(t,n,e){var r=encodeURIComponent(m.replace("%{w}",Object(d.g)(t)).replace("%{h}",Object(d.g)(n)).replace("%{f}",e));return"data:image/svg+xml;charset=UTF-8,".concat(r)}(w,v,r.blankColor||"transparent"),O=null,x=null),r.left?j="float-left":r.right?j="float-right":r.center&&(j="mx-auto",b=!0),t("img",Object(s.a)(i,{attrs:{src:c,alt:a,width:w?Object(d.g)(w):null,height:v?Object(d.g)(v):null,srcset:O||null,sizes:x||null},class:(e={"img-thumbnail":r.thumbnail,"img-fluid":r.fluid||h,"w-100":h,rounded:""===f||!0===f},g(e,"rounded-".concat(f),Object(u.n)(f)&&""!==f),g(e,j,j),g(e,"d-block",b),e)}))}})},573:function(t,n){t.exports="/images/_/_/_/_/admin/resources/js/src/assets/images/pages/error.svg"},574:function(t,n){t.exports="/images/_/_/_/_/admin/resources/js/src/assets/images/pages/error-dark.svg"},646:function(t,n,e){var r=e(1226);"string"==typeof r&&(r=[[t.i,r,""]]);var i={hmr:!0,transform:void 0,insertInto:void 0};e(25)(r,i);r.locals&&(t.exports=r.locals)}}]);