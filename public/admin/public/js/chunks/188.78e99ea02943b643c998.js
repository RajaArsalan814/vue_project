(window.webpackJsonp=window.webpackJsonp||[]).push([[188],{1796:function(t,e,n){"use strict";n.d(e,"a",(function(){return T}));var i,o=n(16),a=n.n(o),s=n(19),r=n(5),c=n(11),l=n(2),u=n(20),h=n(6),b=n(7),f=n(50),m=n(21),p=n(12),v=n(1),d=n(29),w=n(170),O=n(123);function j(t,e){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(t);e&&(i=i.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),n.push.apply(n,i)}return n}function y(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?j(Object(n),!0).forEach((function(e){D(t,e,n[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):j(Object(n)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(n,e))}))}return t}function D(t,e,n){return e in t?Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}var _=Object(f.a)("show",{type:l.i,defaultValue:!1}),g=_.mixin,k=_.props,S=_.prop,C=_.event,P=function(t){return""===t||Object(b.b)(t)?0:(t=Object(m.c)(t,0))>0?t:0},$=function(t){return""===t||!0===t||!(Object(m.c)(t,0)<1)&&!!t},x=Object(v.d)(Object(p.m)(y(y({},k),{},{dismissLabel:Object(v.c)(l.u,"Close"),dismissible:Object(v.c)(l.g,!1),fade:Object(v.c)(l.g,!1),variant:Object(v.c)(l.u,"info")})),r.a),T=a.a.extend({name:r.a,mixins:[g,d.a],props:x,data:function(){return{countDown:0,localShow:$(this[S])}},watch:(i={},D(i,S,(function(t){this.countDown=P(t),this.localShow=$(t)})),D(i,"countDown",(function(t){var e=this;this.clearCountDownInterval();var n=this[S];Object(b.i)(n)&&(this.$emit(c.n,t),n!==t&&this.$emit(C,t),t>0?(this.localShow=!0,this.$_countDownTimeout=setTimeout((function(){e.countDown--}),1e3)):this.$nextTick((function(){Object(h.B)((function(){e.localShow=!1}))})))})),D(i,"localShow",(function(t){var e=this[S];t||!this.dismissible&&!Object(b.i)(e)||this.$emit(c.m),Object(b.i)(e)||e===t||this.$emit(C,t)})),i),created:function(){this.$_filterTimer=null;var t=this[S];this.countDown=P(t),this.localShow=$(t)},beforeDestroy:function(){this.clearCountDownInterval()},methods:{dismiss:function(){this.clearCountDownInterval(),this.countDown=0,this.localShow=!1},clearCountDownInterval:function(){clearTimeout(this.$_countDownTimeout),this.$_countDownTimeout=null}},render:function(t){var e=t();if(this.localShow){var n=this.dismissible,i=this.variant,o=t();n&&(o=t(w.a,{attrs:{"aria-label":this.dismissLabel},on:{click:this.dismiss}},[this.normalizeSlot(u.k)])),e=t("div",{staticClass:"alert",class:D({"alert-dismissible":n},"alert-".concat(i),i),attrs:{role:"alert","aria-live":"polite","aria-atomic":!0},key:this[s.a]},[o,this.normalizeSlot()])}return t(O.a,{props:{noFade:!this.fade}},[e])}})},1909:function(t,e,n){"use strict";n.r(e);var i=n(1796),o=n(57),a={components:{BAlert:i.a,BLink:o.a}},s=n(0),r=Object(s.a)(a,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"p-4"},[n("h4",{staticClass:"mb-2"},[t._v("\n    Layout Blank\n  ")]),t._v(" "),n("b-alert",{attrs:{variant:"primary",show:""}},[n("div",{staticClass:"alert-body"},[n("p",[n("strong",[t._v("Info: ")]),t._v(" "),n("span",[t._v("This layout is used in Authentication & Miscellaneous page. Please check the ")]),t._v(" "),n("b-link",{staticClass:"alert-link",attrs:{href:"https://pixinvent.com/demo/vuexy-vuejs-admin-dashboard-template/documentation/guide/layout/page-layout-examples.html#layout-blank",target:"_blank"}},[t._v("Layout Blank documentation")]),t._v(" "),n("span",[t._v(" for more details.")])],1)])])],1)}),[],!1,null,null,null);e.default=r.exports}}]);