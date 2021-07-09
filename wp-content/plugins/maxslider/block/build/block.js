/*! For license information please see block.js.LICENSE.txt */
window.wp=window.wp||{},window.wp.block=function(e){var t={};function n(r){if(t[r])return t[r].exports;var l=t[r]={i:r,l:!1,exports:{}};return e[r].call(l.exports,l,l.exports,n),l.l=!0,l.exports}return n.m=e,n.c=t,n.d=function(e,t,r){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:r})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var r=Object.create(null);if(n.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var l in e)n.d(r,l,function(t){return e[t]}.bind(null,l));return r},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=10)}([function(e,t){e.exports=window.wp.i18n},function(e,t){e.exports=window.wp.components},function(e,t){e.exports=window.React},function(e,t){e.exports=window.wp.element},function(e,t){e.exports=window.wp.blocks},function(e,t){e.exports=window.wp.data},function(e,t){e.exports=window.wp.blockEditor},function(e,t,n){var r;!function(){"use strict";var n={}.hasOwnProperty;function l(){for(var e=[],t=0;t<arguments.length;t++){var r=arguments[t];if(r){var c=typeof r;if("string"===c||"number"===c)e.push(r);else if(Array.isArray(r)){if(r.length){var i=l.apply(null,r);i&&e.push(i)}}else if("object"===c)if(r.toString===Object.prototype.toString)for(var a in r)n.call(r,a)&&r[a]&&e.push(a);else e.push(r.toString())}}return e.join(" ")}e.exports?(l.default=l,e.exports=l):void 0===(r=function(){return l}.apply(t,[]))||(e.exports=r)}()},function(e,t,n){},,function(e,t,n){"use strict";n.r(t);var r,l=n(0),c=n(4),i=n(3),a=n(5),o=n(1),u=n(6),s=n(7),p=n.n(s),d=[],f=function(e){var t=e.attributes,n=e.setAttributes,r=e.clientId,l=t.uniqueId;Object(i.useEffect)((function(){if(!l||d.includes(l)){var e=r.substr(2,9);return d.push(e),void n({uniqueId:e})}l&&!d.includes(l)&&d.push(l)}),[])},m=n(2);function w(){return(w=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var r in n)Object.prototype.hasOwnProperty.call(n,r)&&(e[r]=n[r])}return e}).apply(this,arguments)}var b=function(e){return m.createElement("svg",w({width:100,height:29,xmlns:"http://www.w3.org/2000/svg"},e),r||(r=m.createElement("g",{fill:"none",fillRule:"evenodd"},m.createElement("path",{d:"M.006 27.412c-.045.296.16.501.433.501h2.689c.228 0 .41-.182.433-.364l1.002-7.04h.046l3.85 7.382c.069.136.251.25.388.25h.41a.533.533 0 00.387-.25l3.828-7.383h.046l1.025 7.04c.023.183.228.365.433.365h2.689c.273 0 .478-.205.432-.501l-2.574-15.311a.436.436 0 00-.41-.365h-.365c-.114 0-.319.091-.387.228l-5.286 9.843h-.046l-5.286-9.843c-.068-.137-.273-.228-.387-.228H2.99a.436.436 0 00-.41.365L.006 27.412zm19.39-2.278c0 1.8 1.345 3.007 3.145 3.007 1.435 0 2.232-.66 2.756-1.14l.32.616c.113.25.273.296.41.296h1.002a.448.448 0 00.433-.433v-5.035c0-2.689-1.025-3.873-3.85-3.873-1.231 0-2.826.273-3.031.341-.205.069-.41.228-.342.615l.205 1.436c.046.342.205.592.547.478.593-.182 1.663-.341 2.279-.341 1.093 0 1.23.455 1.23 1.344 0 0-.73-.365-1.754-.365-2.074 0-3.35 1.3-3.35 3.054zm2.962-.228c0-.524.433-.957.98-.957.547 0 .98.433 1.003.957 0 .547-.456 1.002-1.003 1.002a.992.992 0 01-.98-1.002zm6.972 3.007h2.712c.16 0 .296-.09.364-.182.388-.547 1.003-1.344 1.459-1.982h.068l1.39 1.96c.068.09.182.204.342.204h2.757c.364 0 .546-.387.341-.683l-2.893-3.988 2.87-3.76c.228-.295.046-.683-.341-.683h-2.803c-.228 0-.319.092-.364.183l-1.3 1.868h-.067l-1.276-1.868c-.046-.091-.183-.183-.365-.183h-2.802c-.388 0-.57.388-.342.684l2.87 3.782-2.961 3.965c-.205.296-.046.683.341.683zM59.805 27.48c0 .228.205.433.433.433h2.507a.448.448 0 00.433-.433V12.397a.448.448 0 00-.433-.433h-2.507a.448.448 0 00-.433.433V27.48zm7.497-11.438a1.809 1.809 0 001.822-1.8c0-1.002-.82-1.822-1.822-1.822-1.003 0-1.8.82-1.8 1.822 0 1.003.797 1.8 1.8 1.8zM65.638 27.48c0 .228.205.433.433.433h2.507a.448.448 0 00.432-.433v-8.248a.433.433 0 00-.432-.433H66.07a.433.433 0 00-.433.433v8.248zm5.172-4.124c0 2.62 1.937 4.785 4.512 4.785 2.005 0 3.053-1.435 3.053-1.435l.273.752c.092.25.251.455.479.455h1.07a.448.448 0 00.434-.433V12.397a.448.448 0 00-.433-.433h-2.53a.448.448 0 00-.432.433v6.607c-.274-.16-1.117-.432-1.891-.432-2.438 0-4.535 1.572-4.535 4.784zm3.122-.022c0-1.026.797-1.823 1.846-1.823 1.048 0 1.822.797 1.822 1.823 0 1.048-.774 1.868-1.822 1.868-1.049 0-1.846-.82-1.846-1.868zm8.476.022c0 2.62 2.05 4.785 4.762 4.785 1.435 0 2.575-.501 3.372-1.299.205-.205.16-.478.023-.66l-1.14-1.367c-.136-.16-.364-.16-.569 0-.365.273-1.025.546-1.595.546-1.185 0-1.686-.888-1.754-1.503h5.468a.44.44 0 00.433-.388 5.53 5.53 0 00.045-.615c0-2.506-2.005-4.283-4.329-4.283-2.688 0-4.716 2.21-4.716 4.784zm3.395-1.276c.091-.592.615-1.07 1.23-1.07.593 0 1.162.478 1.208 1.07h-2.438zm7.291 5.4c0 .228.205.433.433.433h2.324c.365 0 .501-.16.501-.433v-4.716c0-.775.524-1.299 1.208-1.299.205 0 .433.069.547.114.25.091.41-.045.5-.205l1.117-1.823c.32-.524-.57-.98-1.822-.98-1.185 0-2.028.844-2.484 1.504l-.41-1.002c-.068-.137-.16-.274-.41-.274h-1.071a.433.433 0 00-.433.433v8.248z",fill:"#01405E",fillRule:"nonzero"}),m.createElement("path",{d:"M51.02 3.516l4.258-.699-.4-2.817 5.959 4.361-4.361 5.959-.4-2.58-4.58.717v.006c-.107.014-.213.028-.318.044l-.156.024c-.822.134-1.578.331-2.282.505a28.38 28.38 0 00-2.29.65c-.604.205-.906.341-.906.41-.022.113.28.267.906.461.627.194 1.407.456 2.341.786.934.33 1.937.752 3.008 1.265a15.356 15.356 0 012.973 1.862 9.068 9.068 0 012.222 2.58c.57.992.82 2.125.752 3.401-.092 1.572-.41 2.86-.957 3.862-.547 1.003-1.242 1.789-2.085 2.359-.843.57-1.806.956-2.888 1.162a18.24 18.24 0 01-3.4.307c-1.186 0-2.257-.268-3.213-.803a8.796 8.796 0 01-2.427-1.965 8.979 8.979 0 01-1.52-2.478c-.354-.877-.508-1.646-.462-2.307.045-.66.102-1.259.17-1.794.069-.536.149-.997.24-1.385.09-.432.193-.831.307-1.196-.022.274-.045.581-.068.923-.023.296-.04.65-.051 1.06-.012.41-.006.865.017 1.367 0-.41.023-.838.068-1.282.046-.444.091-.849.137-1.213l.205-1.23.547-.616.17.41c-.113 1.755.115 3.133.684 4.136.57 1.002 1.31 1.731 2.222 2.187a6.73 6.73 0 002.99.7 13.205 13.205 0 003.06-.307c.956-.216 1.754-.501 2.392-.854.638-.353.968-.667.99-.94.023-.365-.17-.707-.58-1.026-.41-.319-.957-.632-1.64-.94a26.95 26.95 0 00-2.325-.905 97.246 97.246 0 01-2.666-.957 50.791 50.791 0 01-2.683-1.094 12.601 12.601 0 01-2.307-1.298c-.66-.479-1.19-1.02-1.589-1.624a3.176 3.176 0 01-.53-2c.046-.728.103-1.287.171-1.674.069-.387.126-.672.171-.854.069-.205.137-.308.205-.308.023-.615.33-1.156.923-1.623.592-.467 1.327-.872 2.204-1.214a19.345 19.345 0 012.871-.854 36.28 36.28 0 012.957-.53c.337-.045.658-.094.965-.137z",fill:"#FC0"}))))};function h(e){return function(e){if(Array.isArray(e))return v(e)}(e)||function(e){if("undefined"!=typeof Symbol&&null!=e[Symbol.iterator]||null!=e["@@iterator"])return Array.from(e)}(e)||function(e,t){if(!e)return;if("string"==typeof e)return v(e,t);var n=Object.prototype.toString.call(e).slice(8,-1);"Object"===n&&e.constructor&&(n=e.constructor.name);if("Map"===n||"Set"===n)return Array.from(e);if("Arguments"===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n))return v(e,t)}(e)||function(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function v(e,t){(null==t||t>e.length)&&(t=e.length);for(var n=0,r=new Array(t);n<t;n++)r[n]=e[n];return r}function y(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}var g=function(e){var t,n,r,c=e.attributes,s=e.setAttributes,d=e.className,m=e.clientId,w=c.uniqueId,v=c.id,g=c.template,x=p()((y(t={},d,!!d),y(t,"maxslider-block-".concat(w),!!w),t));f({attributes:c,setAttributes:s,clientId:m});var j=Object(a.useSelect)((function(e){return{sliders:(0,e("core").getEntityRecords)("postType","maxslider_slider",{per_page:-1})}})).sliders,O=(null!==(n=window.__MAXSLIDER_SETTINGS__)&&void 0!==n?n:{}).templates,_=!j,E=_?wp.element.createElement("div",{style:{textAlign:"center"}},wp.element.createElement(o.Spinner,null)):wp.element.createElement(o.SelectControl,{label:Object(l.__)("Slider"),value:v,options:[{label:Object(l.__)("Select a slider"),value:""}].concat(h((j||[]).map((function(e){return{label:e.title.raw,value:e.id}})))),onChange:function(e){return s({id:e})}});return wp.element.createElement(i.Fragment,null,wp.element.createElement("div",{id:"maxslider-block-".concat(w),className:x},wp.element.createElement("div",{className:"maxslider-block-placeholder"},wp.element.createElement("div",{className:"maxslider-block-placeholder-inner"},wp.element.createElement(b,{className:"maxslider-block-placeholder-logo",viewBox:"0 0 100 29"}),E))),wp.element.createElement(u.InspectorControls,null,wp.element.createElement(o.PanelBody,{title:Object(l.__)("Settings"),initialOpen:!0},E,!_&&O&&(null===(r=Object.keys(O))||void 0===r?void 0:r.length)>0&&wp.element.createElement(o.SelectControl,{label:Object(l.__)("Template"),value:g,options:h((Object.keys(O)||[]).map((function(e){return{label:O[e].label,value:e}}))),onChange:function(e){s({template:e})}}))))},x=function(){return wp.element.createElement("svg",{width:"24",height:"24",xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 25 25"},wp.element.createElement("g",{transform:"translate(1 1)",fill:"none",fillRule:"evenodd"},wp.element.createElement("rect",{stroke:"#003B56",fill:"#014969",fillRule:"nonzero",width:"23",height:"23",rx:"3"}),wp.element.createElement("path",{d:"m12.397 5 2.42-.398L14.59 3l3.388 2.48-2.48 3.388-.227-1.467-2.604.407v.004a6.91 6.91 0 0 0-.18.025l-.09.014c-.467.076-.897.188-1.297.287-.525.13-.959.252-1.302.369-.343.116-.515.194-.515.233-.013.065.159.152.515.262.356.11.8.26 1.331.447.531.188 1.101.428 1.71.72a8.73 8.73 0 0 1 1.69 1.058c.519.415.94.904 1.264 1.467.324.564.466 1.208.427 1.934-.052.894-.233 1.626-.544 2.196-.31.57-.706 1.017-1.185 1.34a4.34 4.34 0 0 1-1.642.661 10.37 10.37 0 0 1-1.934.175 3.676 3.676 0 0 1-1.826-.457 5 5 0 0 1-1.38-1.117 5.105 5.105 0 0 1-.865-1.409c-.2-.499-.288-.936-.262-1.311.026-.376.058-.716.097-1.02.039-.305.084-.567.136-.788a7.39 7.39 0 0 1 .175-.68c-.013.156-.026.33-.039.525a10.7 10.7 0 0 0-.02 1.38c0-.234.014-.476.04-.73.026-.252.051-.482.077-.689.04-.233.078-.466.117-.7l.31-.35.098.234c-.065.997.065 1.781.389 2.351.324.57.745.985 1.263 1.244a3.84 3.84 0 0 0 1.7.398 7.508 7.508 0 0 0 1.74-.175c.543-.123.997-.285 1.36-.486.362-.2.55-.378.563-.534.013-.207-.097-.401-.33-.583a4.623 4.623 0 0 0-.933-.534c-.389-.175-.83-.347-1.322-.515a55.29 55.29 0 0 1-1.515-.544 28.878 28.878 0 0 1-1.526-.622 7.165 7.165 0 0 1-1.311-.738 3.584 3.584 0 0 1-.904-.923 1.806 1.806 0 0 1-.301-1.137c.026-.415.058-.732.097-.952a7.8 7.8 0 0 1 .097-.486c.04-.117.078-.175.117-.175.013-.35.188-.658.525-.923a4.867 4.867 0 0 1 1.253-.69 10.999 10.999 0 0 1 1.632-.486c.59-.13 1.15-.23 1.681-.3l.549-.079z",fill:"#FC0"})))};n(8);Object(c.registerBlockType)("maxslider/slider",{title:Object(l.__)("MaxSlider"),description:Object(l.__)("Display your MaxSlider slideshow"),icon:x,category:"maxslider",keywords:[Object(l.__)("slider"),Object(l.__)("slideshow"),"maxslider"],supports:{align:["wide","full"]},attributes:{uniqueId:{type:"string"},id:{type:"string"},template:{type:"string"},className:{type:"string",default:""}},edit:g,save:function(){return null}})}]);