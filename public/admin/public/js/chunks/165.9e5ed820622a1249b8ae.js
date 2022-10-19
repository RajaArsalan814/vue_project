(window.webpackJsonp=window.webpackJsonp||[]).push([[165],{1018:function(n,e,t){"use strict";t(526)},1019:function(n,e,t){(e=t(22)(!1)).push([n.i,".card-code pre[class*=language-][data-v-365b0de1] {\n  max-height: 350px;\n}[dir] .card-code pre[class*=language-][data-v-365b0de1] {\n  margin: 0;\n  border-radius: 0.5rem;\n}\n.card-code[data-v-365b0de1] ::-webkit-scrollbar {\n  width: 8px;\n  height: 8px;\n}\n[dir] .card-code[data-v-365b0de1] ::-webkit-scrollbar {\n  background: #2d2d2d;\n  border-radius: 100%;\n}\n[dir] .dark-layout .card-code[data-v-365b0de1] ::-webkit-scrollbar {\n  background-color: #161d31 !important;\n}\n[dir] .card-code[data-v-365b0de1] ::-webkit-scrollbar-track {\n  background: transparent;\n}\n[dir] .card-code[data-v-365b0de1] ::-webkit-scrollbar-thumb {\n  border-radius: 0.5rem;\n  background: rgba(241, 241, 241, 0.4);\n}\n.card-code[data-v-365b0de1] ::-webkit-scrollbar-corner {\n  display: none;\n}\n[dir] .code-toggler[data-v-365b0de1] {\n  border-bottom: 1px solid transparent;\n}\n[dir] .code-toggler[aria-expanded=false][data-v-365b0de1] {\n  border-bottom-color: #7367f0;\n}\n.card .card-header .heading-elements[data-v-365b0de1] {\n  position: static;\n}\n[dir] .card .card-header .heading-elements[data-v-365b0de1] {\n  background: red;\n}",""]),n.exports=e},15:function(n,e,t){"use strict";t(72);var a=t(1793),r=t(327),s=t(329),i=t(328),o=t(1807),l=(t(165),t(180),t(95)),p=t.n(l),c={components:{BCard:a.a,BCardTitle:r.a,BCardSubTitle:s.a,BCardBody:i.a,BCollapse:o.a,Prism:p.a},inheritAttrs:!1,props:{codeLanguage:{default:"markup",type:String}},data:function(){return{parentID:"",code_visible:!1}},computed:{cardAttrs:function(){var n=JSON.parse(JSON.stringify(this.$attrs));return delete n.title,delete n["sub-title"],n}},created:function(){this.parentID=String(Math.floor(10*Math.random())+1)}},d=(t(1018),t(0)),v=Object(d.a)(c,(function(){var n=this,e=n.$createElement,t=n._self._c||e;return t("b-card",n._g(n._b({attrs:{"no-body":""}},"b-card",n.cardAttrs,!1),n.$listeners),[t("div",{staticClass:"card-header"},[t("div",[t("b-card-title",[n._v(n._s(n.$attrs.title))]),n._v(" "),n.$attrs["sub-title"]?t("b-card-sub-title",[n._v("\n        "+n._s(n.$attrs["sub-title"])+"\n      ")]):n._e()],1),n._v(" "),t("i",{staticClass:"code-toggler feather icon-code cursor-pointer",attrs:{"aria-expanded":n.code_visible?"false":"true","aria-controls":n.parentID},on:{click:function(e){n.code_visible=!n.code_visible}}})]),n._v(" "),void 0!==n.$attrs["no-body"]?[n._t("default"),n._v(" "),t("b-collapse",{staticClass:"card-code",attrs:{id:n.parentID,visible:n.code_visible},model:{value:n.code_visible,callback:function(e){n.code_visible=e},expression:"code_visible"}},[t("b-card-body",[t("prism",{attrs:{language:n.codeLanguage}},[n._t("code")],2)],1)],1)]:t("b-card-body",[n._t("default"),n._v(" "),t("b-collapse",{staticClass:"card-code",attrs:{id:n.parentID,visible:n.code_visible},model:{value:n.code_visible,callback:function(e){n.code_visible=e},expression:"code_visible"}},[t("div",{staticClass:"p-1"}),n._v(" "),t("prism",{attrs:{language:n.codeLanguage}},[n._t("code")],2)],1)],2)],2)}),[],!1,null,"365b0de1",null);e.a=v.exports},1872:function(n,e,t){"use strict";t.r(e);var a=t(1790),r=t(332),s=t(1791),i=t(1835),o=t(4),l={components:{BCardCode:o.a,BCardText:s.a,BPaginationNav:i.a},data:function(){return{codeBasic:'\n<template>\n  <b-pagination-nav\n    :link-gen="linkGen"\n    :number-of-pages="10"\n    use-router\n    class="mb-0"\n  />\n</template>\n\n<script>\nimport { BPaginationNav } from \'bootstrap-vue\'\n\nexport default {\n  components: {\n    BPaginationNav,\n  },\n  methods: {\n    linkGen(pageNum) {\n      return pageNum === 1 ? \'?\' : `?page=${pageNum}`\n    },\n  },\n}\n<\/script>\n'}},methods:{linkGen:function(n){return 1===n?"?":"?page=".concat(n)}}},p=t(0),c=Object(p.a)(l,(function(){var n=this,e=n.$createElement,t=n._self._c||e;return t("b-card-code",{attrs:{title:"Basic"},scopedSlots:n._u([{key:"code",fn:function(){return[n._v("\n    "+n._s(n.codeBasic)+"\n  ")]},proxy:!0}])},[t("b-card-text",[t("code",[n._v("<b-pagination-nav>")]),n._v(" "),t("span",[n._v(" is a custom input component that provides navigational pagination. The total number of pages set with the ")]),n._v(" "),t("code",[n._v("number-of-pages")]),n._v(" "),t("span",[n._v(" prop.")])]),n._v(" "),t("b-pagination-nav",{staticClass:"mb-0",attrs:{"link-gen":n.linkGen,"number-of-pages":10,"use-router":""}})],1)}),[],!1,null,null,null).exports,d=(t(169),{components:{BCardCode:o.a,BPaginationNav:i.a,BCardText:s.a},data:function(){return{links:["#foo","#bar","#baz","#faz"],codeNumberGen:"\n<template>\n   <b-pagination-nav\n    :link-gen=\"linkGen\"\n    :page-gen=\"pageGen\"\n    :number-of-pages=\"links.length\"\n  />\n</template>\n\n<script>\nimport { BPaginationNav } from 'bootstrap-vue'\n\nexport default {\n  components: {\n    BPaginationNav,\n  },\n  data() {\n    return {\n      links: ['#foo', '#bar', '#baz', '#faz'],\n    }\n  },\n  methods: {\n    linkGen(pageNum) {\n      return this.links[pageNum - 1]\n    },\n    pageGen(pageNum) {\n      return this.links[pageNum - 1].slice(1)\n    },\n  },\n}\n<\/script>\n"}},methods:{linkGen:function(n){return this.links[n-1]},pageGen:function(n){return this.links[n-1].slice(1)}}}),v=Object(p.a)(d,(function(){var n=this,e=n.$createElement,t=n._self._c||e;return t("b-card-code",{attrs:{title:"Page number generation"},scopedSlots:n._u([{key:"code",fn:function(){return[n._v("\n    "+n._s(n.codeNumberGen)+"\n  ")]},proxy:!0}])},[t("b-card-text",[t("span",[n._v("By default, ")]),n._v(" "),t("code",[n._v("<b-pagination-nav>")]),n._v(" "),t("span",[n._v(" renders page numbers (1-N) in the page link buttons. You can override this behaviour by supplying a function reference to the ")]),n._v(" "),t("code",[n._v("page-gen")]),n._v(" "),t("span",[n._v(" property.")])]),n._v(" "),t("b-pagination-nav",{attrs:{"link-gen":n.linkGen,"page-gen":n.pageGen,"number-of-pages":n.links.length}})],1)}),[],!1,null,null,null).exports,u={components:{BCardCode:o.a,BCardText:s.a,BPaginationNav:i.a},data:function(){return{codeArray:"\n<template>\n  <div>\n    <b-pagination-nav\n      :pages=\"pages1\"\n      use-router\n    />\n    <b-pagination-nav\n      :pages=\"pages2\"\n      use-router\n      class=\"mt-2\"\n    />\n    <b-pagination-nav\n      :pages=\"pages3\"\n      use-router\n      class=\"mt-2\"\n    />\n  </div>\n</template>\n\n<script>\nimport { BPaginationNav } from 'bootstrap-vue'\n\nexport default {\n  components: {\n    BPaginationNav,\n  },\n  data() {\n    return {\n      codeArray,\n      // Simple array of strings\n      pages1: ['?page=1', '?page=2', '?page=3'],\n      // Array of objects with string links\n      pages2: [\n        { link: '?page=1', text: 'One' },\n        { link: '?page=2', text: 'Two' },\n        { link: '?page=3', text: 'Three' },\n      ],\n      pages3: [\n        { link: { query: { page: 1 } }, text: 'Page 1' },\n        { link: { query: { page: 2 } }, text: 'Page 2' },\n        { link: { query: { page: 3 } }, text: 'Page 3' },\n      ],\n    }\n  },\n}\n<\/script>\n",pages1:["?page=1","?page=2","?page=3"],pages2:[{link:"?page=1",text:"One"},{link:"?page=2",text:"Two"},{link:"?page=3",text:"Three"}],pages3:[{link:{query:{page:1}},text:"Page 1"},{link:{query:{page:2}},text:"Page 2"},{link:{query:{page:3}},text:"Page 3"}]}}},g=Object(p.a)(u,(function(){var n=this,e=n.$createElement,t=n._self._c||e;return t("b-card-code",{attrs:{title:"Providing an array of pages"},scopedSlots:n._u([{key:"code",fn:function(){return[n._v("\n    "+n._s(n.codeArray)+"\n  ")]},proxy:!0}])},[t("b-card-text",[t("span",[n._v("Rather than using ")]),n._v(" "),t("code",[n._v("number-of-pages")]),n._v(" "),t("span",[n._v(" to auto generate page links, you can pass an array of links via the ")]),n._v(" "),t("code",[n._v("pages")]),n._v(" "),t("span",[n._v(" prop.")])]),n._v(" "),t("b-pagination-nav",{attrs:{pages:n.pages1,"use-router":""}}),n._v(" "),t("b-pagination-nav",{staticClass:"mt-2",attrs:{pages:n.pages2,"use-router":""}}),n._v(" "),t("b-pagination-nav",{staticClass:"mt-2",attrs:{pages:n.pages3,"use-router":""}})],1)}),[],!1,null,null,null).exports,b=t(557),m={components:{BCardCode:o.a,BPaginationNav:i.a,BCardText:s.a,BSpinner:b.a},data:function(){return{codeButtonContent:'\n<template>\n  \x3c!-- Use text in props --\x3e\n  <b-pagination-nav\n    number-of-pages="10"\n    base-url="#"\n    first-text="First"\n    prev-text="Prev"\n    next-text="Next"\n    last-text="Last"\n  />\n\n  \x3c!-- Use emojis in props --\x3e\n  <b-pagination-nav\n    number-of-pages="10"\n    base-url="#"\n    first-text="⏮"\n    prev-text="⏪"\n    next-text="⏩"\n    last-text="⏭"\n    class="mt-2"\n  />\n\n  \x3c!-- Use HTML and sub-components in slots --\x3e\n  <b-pagination-nav\n    number-of-pages="10"\n    base-url="#"\n    class="mt-2"\n  >\n    <template #first-text>\n      <span class="text-success">First</span>\n    </template>\n    <template #prev-text>\n      <span class="text-danger">Prev</span>\n    </template>\n    <template #next-text>\n      <span class="text-warning">Next</span>\n    </template>\n    <template #last-text>\n      <span class="text-info">Last</span>\n    </template>\n    <template #ellipsis-text>\n      <div>\n        <b-spinner\n          small\n          type="grow"\n        />\n        <b-spinner\n          small\n          type="grow"\n        />\n      </div>\n    </template>\n    <template #page="{ page, active }">\n      <b v-if="active">{{ page }}</b>\n      <i v-else>{{ page }}</i>\n    </template>\n  </b-pagination-nav>\n</template>\n\n<script>\nimport { BPaginationNav, BSpinner } from \'bootstrap-vue\'\n\nexport default {\n  components: {\n    BPaginationNav,\n    BSpinner,\n  },\n}\n<\/script>\n'}}},_=Object(p.a)(m,(function(){var n=this,e=n.$createElement,t=n._self._c||e;return t("b-card-code",{attrs:{title:"Button content"},scopedSlots:n._u([{key:"code",fn:function(){return[n._v("\n    "+n._s(n.codeButtonContent)+"\n  ")]},proxy:!0}])},[t("b-card-text",[t("code",[n._v("<b-pagination-nav>")]),n._v(" "),t("span",[n._v(" supports several props/slots that allow you to customize the appearance.")])]),n._v(" "),t("b-pagination-nav",{attrs:{"number-of-pages":"10","base-url":"#","first-text":"First","prev-text":"Prev","next-text":"Next","last-text":"Last"}}),n._v(" "),t("b-pagination-nav",{staticClass:"mt-2",attrs:{"number-of-pages":"10","base-url":"#","first-text":"⏮","prev-text":"⏪","next-text":"⏩","last-text":"⏭"}}),n._v(" "),t("b-pagination-nav",{staticClass:"mt-2",attrs:{"number-of-pages":"10","base-url":"#"},scopedSlots:n._u([{key:"first-text",fn:function(){return[t("span",{staticClass:"text-success"},[n._v("First")])]},proxy:!0},{key:"prev-text",fn:function(){return[t("span",{staticClass:"text-danger"},[n._v("Prev")])]},proxy:!0},{key:"next-text",fn:function(){return[t("span",{staticClass:"text-warning"},[n._v("Next")])]},proxy:!0},{key:"last-text",fn:function(){return[t("span",{staticClass:"text-info"},[n._v("Last")])]},proxy:!0},{key:"ellipsis-text",fn:function(){return[t("div",[t("b-spinner",{attrs:{small:"",type:"grow"}}),n._v(" "),t("b-spinner",{attrs:{small:"",type:"grow"}})],1)]},proxy:!0},{key:"page",fn:function(e){var a=e.page,r=e.active;return[t(r?"b":"i",[n._v(n._s(a))])]}}])})],1)}),[],!1,null,null,null).exports,f={components:{BCardCode:o.a,BPaginationNav:i.a,BCardText:s.a},data:function(){return{pages:100,currentPage:5,codeGoto:'\n<template>\n  <div>\n    <div>\n      <h6>Goto first button number</h6>\n      <b-pagination-nav\n        v-model="currentPage"\n        :number-of-pages="pages"\n        base-url="#"\n        first-number\n      />\n    </div>\n\n    <div class="mt-2">\n      <h6>Goto last button number</h6>\n      <b-pagination-nav\n        v-model="currentPage"\n        :number-of-pages="pages"\n        base-url="#"\n        last-number\n      />\n    </div>\n\n    <div class="mt-2">\n      <h6>Goto first and last button number</h6>\n      <b-pagination-nav\n        v-model="currentPage"\n        :number-of-pages="pages"\n        base-url="#"\n        first-number\n        last-number\n      />\n    </div>\n  </div>\n</template>\n\n<script>\nimport { BPaginationNav } from \'bootstrap-vue\'\n\nexport default {\n  components: {\n    BPaginationNav,\n  },\n   data() {\n    return {\n      pages: 100,\n      currentPage: 5,\n    }\n  },\n}\n<\/script>\n'}}},x=Object(p.a)(f,(function(){var n=this,e=n.$createElement,t=n._self._c||e;return t("b-card-code",{attrs:{title:"Goto first/last button type"},scopedSlots:n._u([{key:"code",fn:function(){return[n._v("\n    "+n._s(n.codeGoto)+"\n  ")]},proxy:!0}])},[t("b-card-text",[t("span",[n._v("If you prefer to have buttons with the first and last page number to go to the corresponding page, use the ")]),n._v(" "),t("code",[n._v("first-number")]),n._v(" "),t("span",[n._v(" and ")]),n._v(" "),t("code",[n._v("last-number")]),n._v(" "),t("span",[n._v(" props.")])]),n._v(" "),t("div",[t("h6",[n._v("Goto first button number")]),n._v(" "),t("b-pagination-nav",{attrs:{"number-of-pages":n.pages,"base-url":"#","first-number":""},model:{value:n.currentPage,callback:function(e){n.currentPage=e},expression:"currentPage"}})],1),n._v(" "),t("div",{staticClass:"mt-2"},[t("h6",[n._v("Goto last button number")]),n._v(" "),t("b-pagination-nav",{attrs:{"number-of-pages":n.pages,"base-url":"#","last-number":""},model:{value:n.currentPage,callback:function(e){n.currentPage=e},expression:"currentPage"}})],1),n._v(" "),t("div",{staticClass:"mt-2"},[t("h6",[n._v("Goto first and last button number")]),n._v(" "),t("b-pagination-nav",{attrs:{"number-of-pages":n.pages,"base-url":"#","first-number":"","last-number":""},model:{value:n.currentPage,callback:function(e){n.currentPage=e},expression:"currentPage"}})],1)],1)}),[],!1,null,null,null).exports,h={components:{BCardCode:o.a,BPaginationNav:i.a,BCardText:s.a},data:function(){return{codeSize:'\n<template>\n  <div>\n    <div>\n      <h6>Small</h6>\n      <b-pagination-nav\n        size="sm"\n        number-of-pages="10"\n        base-url="#"\n      />\n    </div>\n\n    <div class="mt-2">\n      <h6>Default</h6>\n      <b-pagination-nav\n        number-of-pages="10"\n        base-url="#"\n      />\n    </div>\n\n    <div class="mt-2">\n      <h6>Large</h6>\n      <b-pagination-nav\n        size="lg"\n        number-of-pages="10"\n        base-url="#"\n      />\n    </div>\n  </div>\n</template>\n\n<script>\nimport { BPaginationNav } from \'bootstrap-vue\'\n\nexport default {\n  components: {\n    BPaginationNav,\n  },\n}\n<\/script>\n'}}},y=Object(p.a)(h,(function(){var n=this,e=n.$createElement,t=n._self._c||e;return t("b-card-code",{attrs:{title:"Button size"},scopedSlots:n._u([{key:"code",fn:function(){return[n._v("\n    "+n._s(n.codeSize)+"\n  ")]},proxy:!0}])},[t("b-card-text",[t("span",[n._v("Optionally change from the default button size by setting the ")]),n._v(" "),t("code",[n._v("size")]),n._v(" "),t("span",[n._v(" prop to either ")]),n._v(" "),t("code",[n._v("'sm'")]),n._v(" "),t("span",[n._v(" for smaller buttons or ")]),n._v(" "),t("code",[n._v("'lg'")]),n._v(" "),t("span",[n._v(" for larger buttons.")])]),n._v(" "),t("div",[t("h6",[n._v("Small")]),n._v(" "),t("b-pagination-nav",{attrs:{size:"sm","number-of-pages":"10","base-url":"#"}})],1),n._v(" "),t("div",{staticClass:"mt-2"},[t("h6",[n._v("Default")]),n._v(" "),t("b-pagination-nav",{attrs:{"number-of-pages":"10","base-url":"#"}})],1),n._v(" "),t("div",{staticClass:"mt-2"},[t("h6",[n._v("Large")]),n._v(" "),t("b-pagination-nav",{attrs:{size:"lg","number-of-pages":"10","base-url":"#"}})],1)],1)}),[],!1,null,null,null).exports,k={components:{BCardCode:o.a,BPaginationNav:i.a,BCardText:s.a},data:function(){return{codePill:'\n<template>\n  <div>\n     <div>\n      <h6>Small Pills</h6>\n      <b-pagination-nav\n        pills\n        size="sm"\n        number-of-pages="10"\n        base-url="#"\n      />\n    </div>\n\n    <div class="mt-2">\n      <h6>Default Pills</h6>\n      <b-pagination-nav\n        pills\n        number-of-pages="10"\n        base-url="#"\n      />\n    </div>\n\n    <div class="mt-2">\n      <h6>Large Pills</h6>\n      <b-pagination-nav\n        pills\n        size="lg"\n        number-of-pages="10"\n        base-url="#"\n      />\n    </div>\n  </div>\n</template>\n\n<script>\nimport { BPaginationNav } from \'bootstrap-vue\'\n\nexport default {\n  components: {\n    BPaginationNav,\n  },\n}\n<\/script>\n'}}},P=Object(p.a)(k,(function(){var n=this,e=n.$createElement,t=n._self._c||e;return t("b-card-code",{attrs:{title:"Pill style"},scopedSlots:n._u([{key:"code",fn:function(){return[n._v("\n    "+n._s(n.codePill)+"\n  ")]},proxy:!0}])},[t("b-card-text",[t("span",[n._v("Easily switch to pill style buttons by setting the ")]),n._v(" "),t("code",[n._v("pills")]),n._v(" "),t("span",[n._v(" prop")])]),n._v(" "),t("div",[t("h6",[n._v("Small Pills")]),n._v(" "),t("b-pagination-nav",{attrs:{pills:"",size:"sm","number-of-pages":"10","base-url":"#"}})],1),n._v(" "),t("div",{staticClass:"mt-2"},[t("h6",[n._v("Default Pills")]),n._v(" "),t("b-pagination-nav",{attrs:{pills:"","number-of-pages":"10","base-url":"#"}})],1),n._v(" "),t("div",{staticClass:"mt-2"},[t("h6",[n._v("Large Pills")]),n._v(" "),t("b-pagination-nav",{attrs:{pills:"",size:"lg","number-of-pages":"10","base-url":"#"}})],1)],1)}),[],!1,null,null,null).exports,B=t(537),C={components:{BCardCode:o.a,BPaginationNav:i.a,BFormRadio:B.a,BCardText:s.a},data:function(){return{selected:"default",codeAlignment:'\n<template>\n  <div>\n    <span>Radios using options</span>\n    <div class="my-1">\n      <b-form-radio\n        v-model="selected"\n        name="vuexy-radio"\n        value="default"\n        inline\n      >\n        Default\n      </b-form-radio>\n      <b-form-radio\n        v-model="selected"\n        name="vuexy-radio"\n        value="right"\n        inline\n      >\n        Right\n      </b-form-radio>\n      <b-form-radio\n        v-model="selected"\n        name="vuexy-radio"\n        value="center"\n        inline\n      >\n        Center\n      </b-form-radio>\n      <b-form-radio\n        v-model="selected"\n        name="vuexy-radio"\n        value="fill"\n        inline\n      >\n        Fill\n      </b-form-radio>\n    </div>\n\n    \x3c!-- pagination nav --\x3e\n    <b-pagination-nav\n      number-of-pages="10"\n      base-url="#"\n      :align="selected"\n    />\n  </div>\n</template>\n\n<script>\nimport { BPaginationNav, BFormRadio } from \'bootstrap-vue\'\n\nexport default {\n  components: {\n    BPaginationNav,\n    BFormRadio,\n  },\n  data() {\n    return {\n      selected: \'default\',\n    }\n  },\n}\n<\/script>\n'}}},N=Object(p.a)(C,(function(){var n=this,e=n.$createElement,t=n._self._c||e;return t("b-card-code",{attrs:{title:"Alignment"},scopedSlots:n._u([{key:"code",fn:function(){return[n._v("\n    "+n._s(n.codeAlignment)+"\n  ")]},proxy:!0}])},[t("b-card-text",[t("span",[n._v("By default the pagination component is left aligned. Change the alignment to ")]),n._v(" "),t("code",[n._v("center, right")]),n._v(" "),t("span",[n._v(" (")]),n._v(" "),t("code",[n._v("right")]),n._v(" "),t("span",[n._v(" is an alias for ")]),n._v(" "),t("code",[n._v("end")]),n._v(" "),t("span",[n._v(" )")]),n._v(" "),t("span",[n._v(", or ")]),n._v(" "),t("code",[n._v("fill")]),n._v(" "),t("span",[n._v(" by setting the prop ")]),n._v(" "),t("code",[n._v("align")]),n._v(" "),t("span",[n._v(" to the appropriate value.")])]),n._v(" "),t("div",[t("span",[n._v("Radios using options")]),n._v(" "),t("div",{staticClass:"my-1"},[t("b-form-radio",{attrs:{name:"vuexy-radio",value:"default",inline:""},model:{value:n.selected,callback:function(e){n.selected=e},expression:"selected"}},[n._v("\n        Default\n      ")]),n._v(" "),t("b-form-radio",{attrs:{name:"vuexy-radio",value:"right",inline:""},model:{value:n.selected,callback:function(e){n.selected=e},expression:"selected"}},[n._v("\n        Right\n      ")]),n._v(" "),t("b-form-radio",{attrs:{name:"vuexy-radio",value:"center",inline:""},model:{value:n.selected,callback:function(e){n.selected=e},expression:"selected"}},[n._v("\n        Center\n      ")]),n._v(" "),t("b-form-radio",{attrs:{name:"vuexy-radio",value:"fill",inline:""},model:{value:n.selected,callback:function(e){n.selected=e},expression:"selected"}},[n._v("\n        Fill\n      ")])],1),n._v(" "),t("b-pagination-nav",{attrs:{"number-of-pages":"10","base-url":"#",align:n.selected}})],1)],1)}),[],!1,null,null,null).exports,w={components:{BRow:a.a,BCol:r.a,PaginationNavBasic:c,PaginationNavArray:g,PaginationNavNumberGen:v,PaginationNavButtonContent:_,PaginationNavGoto:x,PaginationNavSize:y,PaginationNavPill:P,PaginationNavAlignment:N}},G=Object(p.a)(w,(function(){var n=this.$createElement,e=this._self._c||n;return e("b-row",{staticClass:"match-height"},[e("b-col",{attrs:{lg:"6"}},[e("pagination-nav-basic")],1),this._v(" "),e("b-col",{attrs:{lg:"6"}},[e("pagination-nav-number-gen")],1),this._v(" "),e("b-col",{attrs:{lg:"6"}},[e("pagination-nav-array")],1),this._v(" "),e("b-col",{attrs:{lg:"6"}},[e("pagination-nav-button-content")],1),this._v(" "),e("b-col",{attrs:{lg:"6"}},[e("pagination-nav-goto")],1),this._v(" "),e("b-col",{attrs:{lg:"6"}},[e("pagination-nav-size")],1),this._v(" "),e("b-col",{attrs:{lg:"6"}},[e("pagination-nav-pill")],1),this._v(" "),e("b-col",{attrs:{lg:"6"}},[e("pagination-nav-alignment")],1)],1)}),[],!1,null,null,null);e.default=G.exports},4:function(n,e,t){"use strict";var a=t(15);e.a=a.a},526:function(n,e,t){var a=t(1019);"string"==typeof a&&(a=[[n.i,a,""]]);var r={hmr:!0,transform:void 0,insertInto:void 0};t(25)(a,r);a.locals&&(n.exports=a.locals)}}]);