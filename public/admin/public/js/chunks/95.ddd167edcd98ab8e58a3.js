(window.webpackJsonp=window.webpackJsonp||[]).push([[95],{1018:function(t,e,n){"use strict";n(526)},1019:function(t,e,n){(e=n(22)(!1)).push([t.i,".card-code pre[class*=language-][data-v-365b0de1] {\n  max-height: 350px;\n}[dir] .card-code pre[class*=language-][data-v-365b0de1] {\n  margin: 0;\n  border-radius: 0.5rem;\n}\n.card-code[data-v-365b0de1] ::-webkit-scrollbar {\n  width: 8px;\n  height: 8px;\n}\n[dir] .card-code[data-v-365b0de1] ::-webkit-scrollbar {\n  background: #2d2d2d;\n  border-radius: 100%;\n}\n[dir] .dark-layout .card-code[data-v-365b0de1] ::-webkit-scrollbar {\n  background-color: #161d31 !important;\n}\n[dir] .card-code[data-v-365b0de1] ::-webkit-scrollbar-track {\n  background: transparent;\n}\n[dir] .card-code[data-v-365b0de1] ::-webkit-scrollbar-thumb {\n  border-radius: 0.5rem;\n  background: rgba(241, 241, 241, 0.4);\n}\n.card-code[data-v-365b0de1] ::-webkit-scrollbar-corner {\n  display: none;\n}\n[dir] .code-toggler[data-v-365b0de1] {\n  border-bottom: 1px solid transparent;\n}\n[dir] .code-toggler[aria-expanded=false][data-v-365b0de1] {\n  border-bottom-color: #7367f0;\n}\n.card .card-header .heading-elements[data-v-365b0de1] {\n  position: static;\n}\n[dir] .card .card-header .heading-elements[data-v-365b0de1] {\n  background: red;\n}",""]),t.exports=e},15:function(t,e,n){"use strict";n(72);var r=n(1793),i=n(327),a=n(329),o=n(328),s=n(1807),c=(n(165),n(180),n(95)),l=n.n(c),u={components:{BCard:r.a,BCardTitle:i.a,BCardSubTitle:a.a,BCardBody:o.a,BCollapse:s.a,Prism:l.a},inheritAttrs:!1,props:{codeLanguage:{default:"markup",type:String}},data:function(){return{parentID:"",code_visible:!1}},computed:{cardAttrs:function(){var t=JSON.parse(JSON.stringify(this.$attrs));return delete t.title,delete t["sub-title"],t}},created:function(){this.parentID=String(Math.floor(10*Math.random())+1)}},p=(n(1018),n(0)),b=Object(p.a)(u,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("b-card",t._g(t._b({attrs:{"no-body":""}},"b-card",t.cardAttrs,!1),t.$listeners),[n("div",{staticClass:"card-header"},[n("div",[n("b-card-title",[t._v(t._s(t.$attrs.title))]),t._v(" "),t.$attrs["sub-title"]?n("b-card-sub-title",[t._v("\n        "+t._s(t.$attrs["sub-title"])+"\n      ")]):t._e()],1),t._v(" "),n("i",{staticClass:"code-toggler feather icon-code cursor-pointer",attrs:{"aria-expanded":t.code_visible?"false":"true","aria-controls":t.parentID},on:{click:function(e){t.code_visible=!t.code_visible}}})]),t._v(" "),void 0!==t.$attrs["no-body"]?[t._t("default"),t._v(" "),n("b-collapse",{staticClass:"card-code",attrs:{id:t.parentID,visible:t.code_visible},model:{value:t.code_visible,callback:function(e){t.code_visible=e},expression:"code_visible"}},[n("b-card-body",[n("prism",{attrs:{language:t.codeLanguage}},[t._t("code")],2)],1)],1)]:n("b-card-body",[t._t("default"),t._v(" "),n("b-collapse",{staticClass:"card-code",attrs:{id:t.parentID,visible:t.code_visible},model:{value:t.code_visible,callback:function(e){t.code_visible=e},expression:"code_visible"}},[n("div",{staticClass:"p-1"}),t._v(" "),n("prism",{attrs:{language:t.codeLanguage}},[t._t("code")],2)],1)],2)],2)}),[],!1,null,"365b0de1",null);e.a=b.exports},1790:function(t,e,n){"use strict";n.d(e,"a",(function(){return O}));var r=n(47),i=n(5),a=n(2),o=n(23),s=n(64),c=n(35),l=n(194),u=n(12),p=n(1),b=n(28);function d(t,e){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);e&&(r=r.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),n.push.apply(n,r)}return n}function m(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?d(Object(n),!0).forEach((function(e){g(t,e,n[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):d(Object(n)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(n,e))}))}return t}function g(t,e,n){return e in t?Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}var v=["start","end","center"],f=Object(l.a)((function(t,e){return(e=Object(b.h)(Object(b.g)(e)))?Object(b.c)(["row-cols",t,e].filter(c.a).join("-")):null})),_=Object(l.a)((function(t){return Object(b.c)(t.replace("cols",""))})),h=[],O={name:i.Ob,functional:!0,get props(){var t;return delete this.props,this.props=(t=Object(s.b)().reduce((function(t,e){return t[Object(p.g)(e,"cols")]=Object(p.c)(a.p),t}),Object(u.c)(null)),h=Object(u.h)(t),Object(p.d)(Object(u.m)(m(m({},t),{},{alignContent:Object(p.c)(a.u,null,(function(t){return Object(o.a)(Object(o.b)(v,"between","around","stretch"),t)})),alignH:Object(p.c)(a.u,null,(function(t){return Object(o.a)(Object(o.b)(v,"between","around"),t)})),alignV:Object(p.c)(a.u,null,(function(t){return Object(o.a)(Object(o.b)(v,"baseline","stretch"),t)})),noGutters:Object(p.c)(a.g,!1),tag:Object(p.c)(a.u,"div")})),i.Ob)),this.props},render:function(t,e){var n,i=e.props,a=e.data,o=e.children,s=i.alignV,c=i.alignH,l=i.alignContent,u=[];return h.forEach((function(t){var e=f(_(t),i[t]);e&&u.push(e)})),u.push((g(n={"no-gutters":i.noGutters},"align-items-".concat(s),s),g(n,"justify-content-".concat(c),c),g(n,"align-content-".concat(l),l),n)),t(i.tag,Object(r.a)(a,{staticClass:"row",class:u}),o)}}},1791:function(t,e,n){"use strict";n.d(e,"a",(function(){return u}));var r=n(16),i=n.n(r),a=n(47),o=n(5),s=n(2),c=n(1),l=Object(c.d)({textTag:Object(c.c)(s.u,"p")},o.u),u=i.a.extend({name:o.u,functional:!0,props:l,render:function(t,e){var n=e.props,r=e.data,i=e.children;return t(n.textTag,Object(a.a)(r,{staticClass:"card-text"}),i)}})},1796:function(t,e,n){"use strict";n.d(e,"a",(function(){return I}));var r,i=n(16),a=n.n(i),o=n(19),s=n(5),c=n(11),l=n(2),u=n(20),p=n(6),b=n(7),d=n(50),m=n(21),g=n(12),v=n(1),f=n(29),_=n(170),h=n(123);function O(t,e){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);e&&(r=r.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),n.push.apply(n,r)}return n}function j(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?O(Object(n),!0).forEach((function(e){y(t,e,n[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):O(Object(n)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(n,e))}))}return t}function y(t,e,n){return e in t?Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}var x=Object(d.a)("show",{type:l.i,defaultValue:!1}),w=x.mixin,C=x.props,B=x.prop,L=x.event,k=function(t){return""===t||Object(b.b)(t)?0:(t=Object(m.c)(t,0))>0?t:0},G=function(t){return""===t||!0===t||!(Object(m.c)(t,0)<1)&&!!t},D=Object(v.d)(Object(g.m)(j(j({},C),{},{dismissLabel:Object(v.c)(l.u,"Close"),dismissible:Object(v.c)(l.g,!1),fade:Object(v.c)(l.g,!1),variant:Object(v.c)(l.u,"info")})),s.a),I=a.a.extend({name:s.a,mixins:[w,f.a],props:D,data:function(){return{countDown:0,localShow:G(this[B])}},watch:(r={},y(r,B,(function(t){this.countDown=k(t),this.localShow=G(t)})),y(r,"countDown",(function(t){var e=this;this.clearCountDownInterval();var n=this[B];Object(b.i)(n)&&(this.$emit(c.n,t),n!==t&&this.$emit(L,t),t>0?(this.localShow=!0,this.$_countDownTimeout=setTimeout((function(){e.countDown--}),1e3)):this.$nextTick((function(){Object(p.B)((function(){e.localShow=!1}))})))})),y(r,"localShow",(function(t){var e=this[B];t||!this.dismissible&&!Object(b.i)(e)||this.$emit(c.m),Object(b.i)(e)||e===t||this.$emit(L,t)})),r),created:function(){this.$_filterTimer=null;var t=this[B];this.countDown=k(t),this.localShow=G(t)},beforeDestroy:function(){this.clearCountDownInterval()},methods:{dismiss:function(){this.clearCountDownInterval(),this.countDown=0,this.localShow=!1},clearCountDownInterval:function(){clearTimeout(this.$_countDownTimeout),this.$_countDownTimeout=null}},render:function(t){var e=t();if(this.localShow){var n=this.dismissible,r=this.variant,i=t();n&&(i=t(_.a,{attrs:{"aria-label":this.dismissLabel},on:{click:this.dismiss}},[this.normalizeSlot(u.k)])),e=t("div",{staticClass:"alert",class:y({"alert-dismissible":n},"alert-".concat(r),r),attrs:{role:"alert","aria-live":"polite","aria-atomic":!0},key:this[o.a]},[i,this.normalizeSlot()])}return t(h.a,{props:{noFade:!this.fade}},[e])}})},1799:function(t,e,n){"use strict";n.d(e,"a",(function(){return O}));var r=n(16),i=n.n(r),a=n(47),o=n(5),s=n(2),c=n(23),l=n(6),u=n(12),p=n(1),b=n(90),d=n(57);function m(t,e){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);e&&(r=r.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),n.push.apply(n,r)}return n}function g(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?m(Object(n),!0).forEach((function(e){v(t,e,n[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):m(Object(n)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(n,e))}))}return t}function v(t,e,n){return e in t?Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}var f=["a","router-link","button","b-link"],_=Object(u.j)(d.b,["event","routerTag"]);delete _.href.default,delete _.to.default;var h=Object(p.d)(Object(u.m)(g(g({},_),{},{action:Object(p.c)(s.g,!1),button:Object(p.c)(s.g,!1),tag:Object(p.c)(s.u,"div"),variant:Object(p.c)(s.u)})),o.tb),O=i.a.extend({name:o.tb,functional:!0,props:h,render:function(t,e){var n,r=e.props,i=e.data,o=e.children,s=r.button,u=r.variant,m=r.active,g=r.disabled,h=Object(b.d)(r),O=s?"button":h?d.a:r.tag,j=!!(r.action||h||s||Object(c.a)(f,r.tag)),y={},x={};return Object(l.t)(O,"button")?(i.attrs&&i.attrs.type||(y.type="button"),r.disabled&&(y.disabled=!0)):x=Object(p.e)(_,r),t(O,Object(a.a)(i,{attrs:y,props:x,staticClass:"list-group-item",class:(n={},v(n,"list-group-item-".concat(u),u),v(n,"list-group-item-action",j),v(n,"active",m),v(n,"disabled",g),n)}),o)}})},1802:function(t,e,n){"use strict";n.d(e,"a",(function(){return p}));var r=n(16),i=n.n(r),a=n(47),o=n(5),s=n(2),c=n(7),l=n(1);var u=Object(l.d)({flush:Object(l.c)(s.g,!1),horizontal:Object(l.c)(s.j,!1),tag:Object(l.c)(s.u,"div")},o.sb),p=i.a.extend({name:o.sb,functional:!0,props:u,render:function(t,e){var n=e.props,r=e.data,i=e.children,o=""===n.horizontal||n.horizontal;o=!n.flush&&o;var s,l,u,p={staticClass:"list-group",class:(s={"list-group-flush":n.flush,"list-group-horizontal":!0===o},l="list-group-horizontal-".concat(o),u=Object(c.n)(o),l in s?Object.defineProperty(s,l,{value:u,enumerable:!0,configurable:!0,writable:!0}):s[l]=u,s)};return t(n.tag,Object(a.a)(r,p),i)}})},1863:function(t,e,n){"use strict";n.r(e);var r=n(332),i=n(1790),a=n(535),o=n(1802),s=n(1791),c=n(1799),l=n(4),u={components:{BCardCode:l.a,BBadge:a.a,BListGroup:o.a,BCardText:s.a,BListGroupItem:c.a},data:function(){return{codeListGroupBadge:'\n<template>\n  \x3c!-- badge --\x3e\n  <b-list-group>\n    <b-list-group-item class="d-flex justify-content-between align-items-center">\n      <span>Biscuit jelly beans macaroon danish pudding.</span>\n      <b-badge\n        variant="primary"\n        pill\n        class="badge-round"\n      >\n        8\n      </b-badge>\n    </b-list-group-item>\n\n    <b-list-group-item class="d-flex justify-content-between align-items-center">\n      <span>chocolate cheesecake candy</span>\n      <b-badge\n        variant="primary"\n        pill\n        class="badge-round"\n      >\n        7\n      </b-badge>\n    </b-list-group-item>\n\n    <b-list-group-item class="d-flex justify-content-between align-items-center">\n      <span>Oat cake icing pastry pie carrot</span>\n      <b-badge\n        variant="primary"\n        pill\n        class="badge-round"\n      >\n        6\n      </b-badge>\n    </b-list-group-item>\n  </b-list-group>\n</template>\n\n<script>\nimport { BListGroup, BListGroupItem, BBadge } from \'bootstrap-vue\'\n\nexport default {\n  components: {\n    BBadge,\n    BListGroup,\n    BListGroupItem,\n  },\n}\n<\/script>\n'}}},p=n(0),b=Object(p.a)(u,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("b-card-code",{attrs:{title:"Badges"},scopedSlots:t._u([{key:"code",fn:function(){return[t._v("\n    "+t._s(t.codeListGroupBadge)+"\n  ")]},proxy:!0}])},[n("b-card-text",[n("span",[t._v("Use Utility classes ")]),t._v(" "),n("code",[t._v(".d-flex .justify-content-between align-items-center")]),t._v(" "),n("span",[t._v(" to create space between badge and your content.")])]),t._v(" "),n("b-list-group",[n("b-list-group-item",{staticClass:"d-flex justify-content-between align-items-center"},[n("span",[t._v("Biscuit jelly beans macaroon danish pudding.")]),t._v(" "),n("b-badge",{staticClass:"badge-round",attrs:{variant:"primary",pill:""}},[t._v("\n        8\n      ")])],1),t._v(" "),n("b-list-group-item",{staticClass:"d-flex justify-content-between align-items-center"},[n("span",[t._v("chocolate cheesecake candy")]),t._v(" "),n("b-badge",{staticClass:"badge-round",attrs:{variant:"primary",pill:""}},[t._v("\n        7\n      ")])],1),t._v(" "),n("b-list-group-item",{staticClass:"d-flex justify-content-between align-items-center"},[n("span",[t._v("Oat cake icing pastry pie carrot")]),t._v(" "),n("b-badge",{staticClass:"badge-round",attrs:{variant:"primary",pill:""}},[t._v("\n        6\n      ")])],1)],1)],1)}),[],!1,null,null,null).exports,d={components:{BCardCode:l.a,BListGroup:o.a,BListGroupItem:c.a,BCardText:s.a},data:function(){return{codeListGroupBasic:"\n<template>\n  <b-list-group>\n    <b-list-group-item>Cras justo odio</b-list-group-item>\n    <b-list-group-item>Dapibus ac facilisis in</b-list-group-item>\n    <b-list-group-item>Morbi leo risus</b-list-group-item>\n    <b-list-group-item>Porta ac consectetur ac</b-list-group-item>\n    <b-list-group-item>Vestibulum at eros</b-list-group-item>\n  </b-list-group>\n</template>\n\n<script>\nimport { BListGroup, BListGroupItem } from 'bootstrap-vue'\n\nexport default {\n  components: {\n    BListGroup,\n    BListGroupItem,\n  },\n}\n<\/script>\n"}}},m=Object(p.a)(d,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("b-card-code",{attrs:{title:"Simple List Group"},scopedSlots:t._u([{key:"code",fn:function(){return[t._v("\n    "+t._s(t.codeListGroupBasic)+"\n  ")]},proxy:!0}])},[n("b-card-text",[t._v("\n    List groups are a flexible and powerful component to display a list of content.\n  ")]),t._v(" "),n("b-list-group",[n("b-list-group-item",[t._v("Cras justo odio")]),t._v(" "),n("b-list-group-item",[t._v("Dapibus ac facilisis in")]),t._v(" "),n("b-list-group-item",[t._v("Morbi leo risus")]),t._v(" "),n("b-list-group-item",[t._v("Porta ac consectetur ac")]),t._v(" "),n("b-list-group-item",[t._v("Vestibulum at eros")])],1)],1)}),[],!1,null,null,null).exports,g={components:{BCardCode:l.a,BListGroup:o.a,BCardText:s.a,BListGroupItem:c.a},data:function(){return{codeIcon:'\n<template>\n  <b-list-group>\n    <b-list-group-item class="d-flex">\n      <span class="mr-1">\n        <feather-icon\n          icon="InstagramIcon"\n          size="16"\n        />\n      </span>\n      <span>Cupcake sesame snaps dessert marzipan.</span>\n    </b-list-group-item>\n\n    <b-list-group-item class="d-flex">\n      <span class="mr-1">\n        <feather-icon\n          icon="FacebookIcon"\n          size="17"\n        />\n      </span>\n      <span>Jelly beans jelly-o gummi bears chupa chups marshmallow.</span>\n    </b-list-group-item>\n\n    <b-list-group-item class="d-flex">\n      <span class="mr-1">\n        <feather-icon\n          icon="TwitterIcon"\n          size="16"\n        />\n      </span>\n      <span>Bonbon macaroon gummies pie jelly</span>\n    </b-list-group-item>\n  </b-list-group>\n</template>\n\n<script>\nimport { BListGroup, BListGroupItem} from \'bootstrap-vue\'\n\nexport default {\n  components: {\n    BListGroup,\n    BListGroupItem,\n  },\n}\n<\/script>\n'}}},v=Object(p.a)(g,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("b-card-code",{attrs:{title:"Icons"},scopedSlots:t._u([{key:"code",fn:function(){return[t._v("\n    "+t._s(t.codeIcon)+"\n  ")]},proxy:!0}])},[n("b-card-text",[n("span",[t._v("To add an icon before your content to create a list group with icons.")])]),t._v(" "),n("b-list-group",[n("b-list-group-item",{staticClass:"d-flex"},[n("span",{staticClass:"mr-1"},[n("feather-icon",{attrs:{icon:"InstagramIcon",size:"16"}})],1),t._v(" "),n("span",[t._v("Cupcake sesame snaps dessert marzipan.")])]),t._v(" "),n("b-list-group-item",{staticClass:"d-flex"},[n("span",{staticClass:"mr-1"},[n("feather-icon",{attrs:{icon:"FacebookIcon",size:"17"}})],1),t._v(" "),n("span",[t._v("Jelly beans jelly-o gummi bears chupa chups marshmallow.")])]),t._v(" "),n("b-list-group-item",{staticClass:"d-flex"},[n("span",{staticClass:"mr-1"},[n("feather-icon",{attrs:{icon:"TwitterIcon",size:"16"}})],1),t._v(" "),n("span",[t._v("Bonbon macaroon gummies pie jelly")])])],1)],1)}),[],!1,null,null,null).exports,f={components:{BCardCode:l.a,BListGroup:o.a,BListGroupItem:c.a,BCardText:s.a},data:function(){return{codeListGroupContextual:'\n<template>\n  <b-list-group>\n    <b-list-group-item variant="primary">\n      Pie fruitcake jelly-o\n    </b-list-group-item>\n    <b-list-group-item variant="secondary">\n      halvah icing marshmallow\n    </b-list-group-item>\n    <b-list-group-item variant="success">\n      Cake caramels donut danish muffin biscuit\n    </b-list-group-item>\n    <b-list-group-item variant="danger">\n      Chocolate cake pie lollipop\n    </b-list-group-item>\n    <b-list-group-item variant="warning">\n      Apple pie toffee pudding gummi bears\n    </b-list-group-item>\n    <b-list-group-item variant="info">\n      Jujubes chupa chups cheesecake tart\n    </b-list-group-item>\n    <b-list-group-item variant="dark">\n      Candy fruitcake bonbon sesame snaps dessert\n    </b-list-group-item>\n  </b-list-group>\n</template>\n\n\n<script>\nimport { BListGroup, BListGroupItem } from \'bootstrap-vue\'\n\nexport default {\n  components: {\n    BListGroup,\n    BListGroupItem,\n  },\n}\n<\/script>\n'}}},_=Object(p.a)(f,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("b-card-code",{attrs:{title:"Contextual Classes"},scopedSlots:t._u([{key:"code",fn:function(){return[t._v("\n    "+t._s(t.codeListGroupContextual)+"\n  ")]},proxy:!0}])},[n("b-card-text",[n("span",[t._v("Use contextual variants to style list items with a stateful background and color, via the")]),t._v(" "),n("code",[t._v("variant")]),t._v(" "),n("span",[t._v("prop.")])]),t._v(" "),n("b-list-group",[n("b-list-group-item",{attrs:{variant:"primary"}},[t._v("\n      Pie fruitcake jelly-o\n    ")]),t._v(" "),n("b-list-group-item",{attrs:{variant:"secondary"}},[t._v("\n      halvah icing marshmallow\n    ")]),t._v(" "),n("b-list-group-item",{attrs:{variant:"success"}},[t._v("\n      Cake caramels donut danish muffin biscuit\n    ")]),t._v(" "),n("b-list-group-item",{attrs:{variant:"danger"}},[t._v("\n      Chocolate cake pie lollipop\n    ")]),t._v(" "),n("b-list-group-item",{attrs:{variant:"warning"}},[t._v("\n      Apple pie toffee pudding gummi bears\n    ")]),t._v(" "),n("b-list-group-item",{attrs:{variant:"info"}},[t._v("\n      Jujubes chupa chups cheesecake tart\n    ")]),t._v(" "),n("b-list-group-item",{attrs:{variant:"dark"}},[t._v("\n      Candy fruitcake bonbon sesame snaps dessert\n    ")])],1)],1)}),[],!1,null,null,null).exports,h={components:{BCardCode:l.a,BListGroup:o.a,BListGroupItem:c.a,BCardText:s.a},data:function(){return{codeListGroupDisable:"\n<template>\n  <b-list-group>\n    <b-list-group-item disabled>\n      Cras justo odio\n    </b-list-group-item>\n    <b-list-group-item>Dapibus ac facilisis in</b-list-group-item>\n    <b-list-group-item>Morbi leo risus</b-list-group-item>\n    <b-list-group-item>Porta ac consectetur ac</b-list-group-item>\n    <b-list-group-item>Vestibulum at eros</b-list-group-item>\n  </b-list-group>\n</template>\n\n<script>\nimport {BListGroup, BListGroupItem } from 'bootstrap-vue'\n\nexport default {\n  components: {\n    BListGroup,\n    BListGroupItem,\n  },\n}\n<\/script>\n"}}},O=Object(p.a)(h,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("b-card-code",{attrs:{title:"Disabled Items"},scopedSlots:t._u([{key:"code",fn:function(){return[t._v("\n    "+t._s(t.codeListGroupDisable)+"\n  ")]},proxy:!0}])},[n("b-card-text",[n("span",[t._v("Set the ")]),t._v(" "),n("code",[t._v("disabled")]),t._v(" "),n("span",[t._v(" prop on a ")]),t._v(" "),n("code",[t._v("<b-list-group-item>")]),t._v(" "),n("span",[t._v(" to make it appear disabled (also works with actionalable items. see below).")])]),t._v(" "),n("b-list-group",[n("b-list-group-item",{attrs:{disabled:""}},[t._v("\n      Cras justo odio\n    ")]),t._v(" "),n("b-list-group-item",[t._v("Dapibus ac facilisis in")]),t._v(" "),n("b-list-group-item",[t._v("Morbi leo risus")]),t._v(" "),n("b-list-group-item",[t._v("Porta ac consectetur ac")]),t._v(" "),n("b-list-group-item",[t._v("Vestibulum at eros")])],1)],1)}),[],!1,null,null,null).exports,j=n(1796),y={components:{BCardCode:l.a,BListGroup:o.a,BCardText:s.a,BListGroupItem:c.a,BAlert:j.a},data:function(){return{codeListGroupHorizontal:"\n<template>\n  <b-list-group horizontal=\"md\">\n    <b-list-group-item>Chocolate cake</b-list-group-item>\n    <b-list-group-item>Cookie pie</b-list-group-item>\n    <b-list-group-item>Cheesecake</b-list-group-item>\n    <b-list-group-item>Cotton candy</b-list-group-item>\n  </b-list-group>\n</template>\n\n<script>\nimport { BListGroup, BListGroupItem } from 'bootstrap-vue'\n\nexport default {\n  components: {\n    BListGroup,\n    BListGroupItem,\n  },\n}\n<\/script>\n"}}},x=Object(p.a)(y,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("b-card-code",{attrs:{title:"Horizontal"},scopedSlots:t._u([{key:"code",fn:function(){return[t._v("\n    "+t._s(t.codeListGroupHorizontal)+"\n  ")]},proxy:!0}])},[n("b-card-text",[n("span",[t._v("Set the prop")]),t._v(" "),n("code",[t._v("horizontal")]),n("span",[t._v("to")]),t._v(" "),n("code",[t._v("true")]),t._v(" "),n("span",[t._v("to change the layout of list group items from vertical to horizontal across all breakpoints. Alternatively,\n      set")]),t._v(" "),n("code",[t._v("horizontal")]),t._v(" "),n("span",[t._v("to a responsive breakpoint")]),t._v(" "),n("code",[t._v("(sm, md, lg or xl)")]),t._v(" "),n("span",[t._v("\n      to make a list group horizontal starting at that breakpoint's min-width. Currently horizontal list groups\n      cannot be combined with")]),t._v(" "),n("code",[t._v("flush")]),t._v(" "),n("span",[t._v("list groups.")])]),t._v(" "),n("b-alert",{attrs:{show:""}},[n("div",{staticClass:"alert-body"},[n("span",{staticClass:"mr-25"},[n("feather-icon",{attrs:{icon:"InfoIcon"}})],1),t._v(" "),n("span",{staticClass:"ml-25"},[t._v("horizontal list groups cannot be combined with flush list groups.")])])]),t._v(" "),n("b-list-group",{attrs:{horizontal:"md"}},[n("b-list-group-item",[t._v("Chocolate cake")]),t._v(" "),n("b-list-group-item",[t._v("Cookie pie")]),t._v(" "),n("b-list-group-item",[t._v("Cheesecake")]),t._v(" "),n("b-list-group-item",[t._v("Cotton candy")])],1)],1)}),[],!1,null,null,null).exports,w={components:{BCardCode:l.a,BListGroup:o.a,BListGroupItem:c.a,BCardText:s.a},data:function(){return{codeListGroupAction:'\n<template>\n  <b-list-group>\n    <b-list-group-item href="#some-link">Awesome link</b-list-group-item>\n    <b-list-group-item href="#" active>Link with active state</b-list-group-item>\n    <b-list-group-item href="#">Action links are easy</b-list-group-item>\n    <b-list-group-item href="#">Action links are fast</b-list-group-item>\n    <b-list-group-item href="#foobar" disabled>Disabled link</b-list-group-item>\n  </b-list-group>\n</template>\n\n<script>\nimport { BListGroup, BListGroupItem } from \'bootstrap-vue\'\n\nexport default {\n  components: {\n    BListGroup,\n    BListGroupItem,\n  },\n}\n<\/script>\n'}}},C=Object(p.a)(w,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("b-card-code",{attrs:{title:"Anchors"},scopedSlots:t._u([{key:"code",fn:function(){return[t._v("\n    "+t._s(t.codeListGroupAction)+"\n  ")]},proxy:!0}])},[n("b-card-text",[n("span",[t._v("Turn a ")]),t._v(" "),n("code",[t._v("<b-list-group-item>")]),t._v(" "),n("span",[t._v(" into an actionable link ")]),t._v(" "),n("code",[t._v('(<a href="...">)')]),t._v(" "),n("span",[t._v(" by specifying either an ")]),t._v(" "),n("code",[t._v("href")]),t._v(" "),n("span",[t._v(" prop or ")]),t._v(" "),n("code",[t._v("router-link")]),t._v(" "),n("span",[t._v(" prop.")])]),t._v(" "),n("b-list-group",[n("b-list-group-item",{attrs:{active:"",href:"#some-link"}},[t._v("\n      Awesome link\n    ")]),t._v(" "),n("b-list-group-item",{attrs:{href:"#"}},[t._v("\n      Link with active state\n    ")]),t._v(" "),n("b-list-group-item",{attrs:{href:"#"}},[t._v("\n      Action links are easy\n    ")]),t._v(" "),n("b-list-group-item",{attrs:{href:"#"}},[t._v("\n      Action links are fast\n    ")]),t._v(" "),n("b-list-group-item",{attrs:{href:"#foobar",disabled:""}},[t._v("\n      Disabled link\n    ")])],1)],1)}),[],!1,null,null,null).exports,B={components:{BCardCode:l.a,BListGroup:o.a,BListGroupItem:c.a,BCardText:s.a},data:function(){return{codeListGroupActionButton:"\n<template>\n  <b-list-group>\n    <b-list-group-item button>Button item</b-list-group-item>\n    <b-list-group-item button>Button item in list</b-list-group-item>\n    <b-list-group-item button>I am a button</b-list-group-item>\n    <b-list-group-item button disabled>Disabled button</b-list-group-item>\n    <b-list-group-item button>This is a button too</b-list-group-item>\n  </b-list-group>\n</template>\n\n<script>\nimport { BListGroup, BListGroupItem } from 'bootstrap-vue'\n\nexport default {\n  components: {\n    BListGroup,\n    BListGroupItem,\n  },\n}\n<\/script>\n"}}},L=Object(p.a)(B,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("b-card-code",{attrs:{title:"Buttons"},scopedSlots:t._u([{key:"code",fn:function(){return[t._v("\n    "+t._s(t.codeListGroupActionButton)+"\n  ")]},proxy:!0}])},[n("b-card-text",[n("span",[t._v("Or if you prefer ")]),t._v(" "),n("code",[t._v("<button>")]),t._v(" "),n("span",[t._v(" elements over links, set the ")]),t._v(" "),n("code",[t._v("button")]),t._v(" "),n("span",[t._v(" prop to true.")])]),t._v(" "),n("b-list-group",[n("b-list-group-item",{attrs:{active:"",button:""}},[t._v("\n      Button item\n    ")]),t._v(" "),n("b-list-group-item",{attrs:{button:""}},[t._v("\n      Button item in list\n    ")]),t._v(" "),n("b-list-group-item",{attrs:{button:""}},[t._v("\n      I am a button\n    ")]),t._v(" "),n("b-list-group-item",{attrs:{button:"",disabled:""}},[t._v("\n      Disabled button\n    ")]),t._v(" "),n("b-list-group-item",{attrs:{button:""}},[t._v("\n      This is a button too\n    ")])],1)],1)}),[],!1,null,null,null).exports,k={components:{BCardCode:l.a,BListGroup:o.a,BCardText:s.a,BListGroupItem:c.a},data:function(){return{codeFlush:"\n<template>\n  <b-list-group flush>\n    <b-list-group-item>Sweet gummi bears gingerbread carrot</b-list-group-item>\n    <b-list-group-item>Cake macaroon brownie wafer soufflé</b-list-group-item>\n    <b-list-group-item>Jelly beans lemon drops</b-list-group-item>\n    <b-list-group-item>Lollipop ice cream donut chupa chups</b-list-group-item>\n    <b-list-group-item>Chocolate candy canes tootsie roll</b-list-group-item>\n  </b-list-group>\n</template>\n\n<script>\nimport { BListGroup, BListGroupItem } from 'bootstrap-vue'\n\nexport default {\n  components: {\n    BListGroup,\n    BListGroupItem,\n  },\n}\n<\/script>\n"}}},G=Object(p.a)(k,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("b-card-code",{attrs:{title:"Flush"},scopedSlots:t._u([{key:"code",fn:function(){return[t._v("\n    "+t._s(t.codeFlush)+"\n  ")]},proxy:!0}])},[n("b-card-text",[n("span",[t._v("Use ")]),t._v(" "),n("code",[t._v("flush")]),t._v(" "),n("span",[t._v(" prop for borderless list group.")])]),t._v(" "),n("b-list-group",{attrs:{flush:""}},[n("b-list-group-item",[t._v("Sweet gummi bears gingerbread carrot")]),t._v(" "),n("b-list-group-item",[t._v("Cake macaroon brownie wafer soufflé")]),t._v(" "),n("b-list-group-item",[t._v("Jelly beans lemon drops")]),t._v(" "),n("b-list-group-item",[t._v("Lollipop ice cream donut chupa chups")]),t._v(" "),n("b-list-group-item",[t._v("Chocolate candy canes tootsie roll")])],1)],1)}),[],!1,null,null,null).exports,D={components:{BCardCode:l.a,BListGroup:o.a,BListGroupItem:c.a,BCardText:s.a},data:function(){return{codeCustom:'\n<template>\n  <b-list-group>\n    <b-list-group-item\n      active\n      class="flex-column align-items-start"\n    >\n      <div class="d-flex w-100 justify-content-between">\n        <h5 class="mb-1 text-white">\n          List group item heading\n        </h5>\n        <small class="text-secondary">3 days ago</small>\n      </div>\n      <b-card-text class="mb-1">\n        Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.\n      </b-card-text>\n      <small class="text-secondary">Donec id elit non mi porta.</small>\n    </b-list-group-item>\n\n    <b-list-group-item class="flex-column align-items-start">\n      <div class="d-flex w-100 justify-content-between">\n        <h5 class="mb-1">\n          List group item heading\n        </h5>\n        <small class="text-secondary">3 days ago</small>\n      </div>\n      <b-card-text class="mb-1">\n        Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.\n      </b-card-text>\n      <small class="text-secondary">Donec id elit non mi porta.</small>\n    </b-list-group-item>\n\n    <b-list-group-item class="flex-column align-items-start">\n      <div class="d-flex w-100 justify-content-between">\n        <h5 class="mb-1">\n          Disabled List group item\n        </h5>\n        <small class="text-secondary">3 days ago</small>\n      </div>\n      <b-card-text class="mb-1">\n        Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.\n      </b-card-text>\n      <small class="text-secondary">Donec id elit non mi porta.</small>\n    </b-list-group-item>\n  </b-list-group>\n</template>\n\n<script>\nimport { BListGroup, BListGroupItem } from \'bootstrap-vue\'\n\nexport default {\n  components: {\n    BListGroup,\n    BListGroupItem,\n  },\n}\n<\/script>\n'}}},I=Object(p.a)(D,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("b-card-code",{attrs:{title:"Custom content"},scopedSlots:t._u([{key:"code",fn:function(){return[t._v("\n    "+t._s(t.codeCustom)+"\n  ")]},proxy:!0}])},[n("b-list-group",[n("b-list-group-item",{staticClass:"flex-column align-items-start",attrs:{active:""}},[n("div",{staticClass:"d-flex w-100 justify-content-between"},[n("h5",{staticClass:"mb-1 text-white"},[t._v("\n          List group item heading\n        ")]),t._v(" "),n("small",{staticClass:"text-secondary"},[t._v("3 days ago")])]),t._v(" "),n("b-card-text",{staticClass:"mb-1"},[t._v("\n        Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.\n      ")]),t._v(" "),n("small",{staticClass:"text-secondary"},[t._v("Donec id elit non mi porta.")])],1),t._v(" "),n("b-list-group-item",{staticClass:"flex-column align-items-start"},[n("div",{staticClass:"d-flex w-100 justify-content-between"},[n("h5",{staticClass:"mb-1"},[t._v("\n          List group item heading\n        ")]),t._v(" "),n("small",{staticClass:"text-secondary"},[t._v("3 days ago")])]),t._v(" "),n("b-card-text",{staticClass:"mb-1"},[t._v("\n        Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.\n      ")]),t._v(" "),n("small",{staticClass:"text-secondary"},[t._v("Donec id elit non mi porta.")])],1),t._v(" "),n("b-list-group-item",{staticClass:"flex-column align-items-start"},[n("div",{staticClass:"d-flex w-100 justify-content-between"},[n("h5",{staticClass:"mb-1"},[t._v("\n          Disabled List group item\n        ")]),t._v(" "),n("small",{staticClass:"text-secondary"},[t._v("3 days ago")])]),t._v(" "),n("b-card-text",{staticClass:"mb-1"},[t._v("\n        Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.\n      ")]),t._v(" "),n("small",{staticClass:"text-secondary"},[t._v("Donec id elit non mi porta.")])],1)],1)],1)}),[],!1,null,null,null).exports,P={components:{BCol:r.a,BRow:i.a,ListGroupBadge:b,ListGroupBasic:m,ListGroupIcon:v,ListGroupContextual:_,ListGroupDisable:O,ListGroupHorizontal:x,ListGroupAction:C,ListGroupActionButton:L,ListGroupFlush:G,ListGroupCustom:I}},S=Object(p.a)(P,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("b-row",{staticClass:"match-height"},[n("b-col",{attrs:{lg:"6"}},[n("list-group-basic")],1),t._v(" "),n("b-col",{attrs:{lg:"6"}},[n("list-group-disable")],1),t._v(" "),n("b-col",{attrs:{lg:"6"}},[n("list-group-icon")],1),t._v(" "),n("b-col",{attrs:{lg:"6"}},[n("list-group-badge")],1),t._v(" "),n("b-col",{attrs:{lg:"6"}},[n("list-group-action")],1),t._v(" "),n("b-col",{attrs:{lg:"6"}},[n("list-group-action-button")],1),t._v(" "),n("b-col",{attrs:{lg:"6"}},[n("list-group-contextual")],1),t._v(" "),n("b-col",{attrs:{lg:"6"}},[n("list-group-custom")],1),t._v(" "),n("b-col",{attrs:{lg:"6"}},[n("list-group-flush")],1),t._v(" "),n("b-col",{attrs:{lg:"6"}},[n("list-group-horizontal")],1)],1)}),[],!1,null,null,null);e.default=S.exports},332:function(t,e,n){"use strict";n.d(e,"a",(function(){return j}));var r=n(47),i=n(5),a=n(2),o=n(43),s=n(23),c=n(64),l=n(35),u=n(7),p=n(194),b=n(12),d=n(1),m=n(28);function g(t,e){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);e&&(r=r.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),n.push.apply(n,r)}return n}function v(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?g(Object(n),!0).forEach((function(e){f(t,e,n[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):g(Object(n)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(n,e))}))}return t}function f(t,e,n){return e in t?Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}var _=["auto","start","end","center","baseline","stretch"],h=Object(p.a)((function(t,e,n){var r=t;if(!Object(u.p)(n)&&!1!==n)return e&&(r+="-".concat(e)),"col"!==t||""!==n&&!0!==n?(r+="-".concat(n),Object(m.c)(r)):Object(m.c)(r)})),O=Object(b.c)(null),j={name:i.y,functional:!0,get props(){return delete this.props,this.props=(t=Object(c.b)().filter(l.a),e=t.reduce((function(t,e){return t[e]=Object(d.c)(a.i),t}),Object(b.c)(null)),n=t.reduce((function(t,e){return t[Object(d.g)(e,"offset")]=Object(d.c)(a.p),t}),Object(b.c)(null)),r=t.reduce((function(t,e){return t[Object(d.g)(e,"order")]=Object(d.c)(a.p),t}),Object(b.c)(null)),O=Object(b.a)(Object(b.c)(null),{col:Object(b.h)(e),offset:Object(b.h)(n),order:Object(b.h)(r)}),Object(d.d)(Object(b.m)(v(v(v(v({},e),n),r),{},{alignSelf:Object(d.c)(a.u,null,(function(t){return Object(s.a)(_,t)})),col:Object(d.c)(a.g,!1),cols:Object(d.c)(a.p),offset:Object(d.c)(a.p),order:Object(d.c)(a.p),tag:Object(d.c)(a.u,"div")})),i.y));var t,e,n,r},render:function(t,e){var n,i=e.props,a=e.data,s=e.children,c=i.cols,l=i.offset,u=i.order,p=i.alignSelf,b=[];for(var d in O)for(var m=O[d],g=0;g<m.length;g++){var v=h(d,m[g].replace(d,""),i[m[g]]);v&&b.push(v)}var _=b.some((function(t){return o.e.test(t)}));return b.push((f(n={col:i.col||!_&&!c},"col-".concat(c),c),f(n,"offset-".concat(l),l),f(n,"order-".concat(u),u),f(n,"align-self-".concat(p),p),n)),t(i.tag,Object(r.a)(a,{class:b}),s)}}},4:function(t,e,n){"use strict";var r=n(15);e.a=r.a},526:function(t,e,n){var r=n(1019);"string"==typeof r&&(r=[[t.i,r,""]]);var i={hmr:!0,transform:void 0,insertInto:void 0};n(25)(r,i);r.locals&&(t.exports=r.locals)},535:function(t,e,n){"use strict";n.d(e,"a",(function(){return f}));var r=n(16),i=n.n(r),a=n(47),o=n(5),s=n(2),c=n(12),l=n(1),u=n(90),p=n(57);function b(t,e){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);e&&(r=r.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),n.push.apply(n,r)}return n}function d(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?b(Object(n),!0).forEach((function(e){m(t,e,n[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):b(Object(n)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(n,e))}))}return t}function m(t,e,n){return e in t?Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}var g=Object(c.j)(p.b,["event","routerTag"]);delete g.href.default,delete g.to.default;var v=Object(l.d)(Object(c.m)(d(d({},g),{},{pill:Object(l.c)(s.g,!1),tag:Object(l.c)(s.u,"span"),variant:Object(l.c)(s.u,"secondary")})),o.e),f=i.a.extend({name:o.e,functional:!0,props:v,render:function(t,e){var n=e.props,r=e.data,i=e.children,o=n.active,s=n.disabled,c=Object(u.d)(n),b=c?p.a:n.tag,d=n.variant||"secondary";return t(b,Object(a.a)(r,{staticClass:"badge",class:["badge-".concat(d),{"badge-pill":n.pill,active:o,disabled:s}],props:c?Object(l.e)(g,n):{}}),i)}})}}]);