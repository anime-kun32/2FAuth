import{Q as G,b as H,a3 as R,S as J,r as m,o as O,d as Q,J as z,a0 as q,e as _,f as l,g as c,m as n,h as t,p as f,i as o,l as d,t as a,w as X,j as g,F as Y,G as Z,k as ee,U as se,n as A,D as S,I as y}from"./app-06176200.js";import{F as te}from"./Form-87bc0477.js";import{_ as oe}from"./SettingTabs-485a4095.js";import{S as ne}from"./Spinner-1a29b2e3.js";/*! 2FAuth version 5.0.4 - Copyright (c) 2023 Bubka - https://github.com/Bubka/2FAuth */const ae={class:"options-tabs"},ie=["innerHTML"],le={class:"title is-4 has-text-grey-light"},re={class:"is-size-7-mobile"},ce={class:"mt-3"},ue=["onKeyup"],de={key:1},me={class:"tags is-pulled-right"},_e=["onClick"],fe=["onClick","title"],pe={key:1,class:"is-size-7-mobile is-size-6 my-3"},ve={key:2,class:"pat is-family-monospace is-size-6 is-size-7-mobile has-text-success"},he={class:"mt-2 is-size-7 is-pulled-right"},ke={key:0,class:"is-overlay modal-otp modal-background"},ge={class:"main-section"},ye=["onSubmit"],be={class:"field is-grouped"},Te={class:"control"},Ce={class:"control"},ze={__name:"OAuth",setup(we){const x=G("2fauth"),p=H(),E=R(x.prefix+"returnTo","accounts"),{copy:L}=J({legacy:!0}),r=m([]),b=m(!1),T=m(!1),v=m(!1),h=m(null),C=m(null);O(()=>{w()});const u=Q(new te({name:""}));function w(){b.value=!0,z.getPersonalAccessTokens({returnError:!0}).then(e=>{r.value=[],e.data.forEach(i=>{i.id===C.value?(i.value=h.value,r.value.unshift(i)):r.value.push(i)})}).catch(e=>{e.response.status===405?T.value=!0:p.error(e)}).finally(()=>{b.value=!1,C.value=null,h.value=null})}function F(){P(),T.value?p.warn({text:y("errors.unsupported_with_reverseproxy")}):v.value=!0}function M(){u.post("/oauth/personal-access-tokens").then(e=>{h.value=e.data.accessToken,C.value=e.data.token.id,w(),v.value=!1,u.reset()})}function N(e){confirm(y("settings.confirm.revoke"))&&z.deletePersonalAccessToken(e).then(i=>{r.value=r.value.filter(k=>k.id!==e),p.success({text:y("settings.token_revoked")})})}function P(){r.value.forEach(e=>{e.value=null}),h.value=null}function K(e){L(e),p.success({text:y("commons.copied_to_clipboard")})}function I(){v.value=!1,u.reset()}return q(e=>{e.name.startsWith("settings.")||p.clear()}),(e,i)=>{const k=_("FontAwesomeIcon"),U=_("ButtonBackCloseCancel"),W=_("VueFooter"),V=_("FormWrapper"),j=_("FormField"),$=_("VueButton");return l(),c("div",null,[n(oe,{activeTab:"settings.oauth.tokens"},null,8,["activeTab"]),t("div",ae,[n(V,null,{default:f(()=>[o(T)?(l(),c("div",{key:0,class:"notification is-warning has-text-centered",innerHTML:e.$t("auth.auth_handled_by_proxy")},null,8,ie)):d("",!0),t("h4",le,a(e.$t("settings.personal_access_tokens")),1),t("div",re,a(e.$t("settings.token_legend")),1),t("div",ce,[t("a",{tabindex:"0",class:"is-link",onClick:F,onKeyup:X(F,["enter"])},[n(k,{icon:["fas","plus-circle"]}),g(" "+a(e.$t("settings.generate_new_token")),1)],40,ue)]),o(r).length>0?(l(),c("div",de,[(l(!0),c(Y,null,Z(o(r),s=>(l(),c("div",{key:s.id,class:"group-item is-size-5 is-size-6-mobile"},[s.value?(l(),ee(k,{key:0,class:"has-text-success",icon:["fas","check"]})):d("",!0),g(" "+a(s.name)+" ",1),t("div",me,[n(o(se),null,{default:f(({mode:B})=>[s.value?(l(),c("button",{key:0,class:A(["button tag",{"is-link":B!="dark"}]),onClick:S(D=>K(s.value),["stop"])},a(e.$t("commons.copy")),11,_e)):d("",!0),t("button",{class:A(["button tag",B==="dark"?"is-dark":"is-white"]),onClick:D=>N(s.id),title:e.$t("settings.revoke")},a(e.$t("settings.revoke")),11,fe)]),_:2},1024)]),s.value?(l(),c("span",pe,a(e.$t("settings.make_sure_copy_token")),1)):d("",!0),s.value?(l(),c("span",ve,a(s.value),1)):d("",!0)]))),128)),t("div",he,a(e.$t("settings.revoking_a_token_is_permanent")),1)])):d("",!0),n(ne,{isVisible:o(b)&&o(r).length===0},null,8,["isVisible"]),n(W,{showButtons:!0},{default:f(()=>[n(U,{returnTo:{name:o(E)},action:"close"},null,8,["returnTo"])]),_:1})]),_:1})]),o(v)?(l(),c("div",ke,[t("main",ge,[n(V,{title:"settings.forms.new_token"},{default:f(()=>[t("form",{onSubmit:S(M,["prevent"]),onKeydown:i[1]||(i[1]=s=>o(u).onKeydown(s))},[n(j,{modelValue:o(u).name,"onUpdate:modelValue":i[0]||(i[0]=s=>o(u).name=s),fieldName:"name",fieldError:o(u).errors.get("name"),inputType:"text",label:"commons.name",autofocus:""},null,8,["modelValue","fieldError"]),t("div",be,[t("div",Te,[n($,{id:"btnGenerateToken",isLoading:o(u).isBusy},{default:f(()=>[g(a(e.$t("commons.generate")),1)]),_:1},8,["isLoading"])]),t("div",Ce,[n($,{onClick:I,nativeType:"button",id:"btnCancel",color:"is-text"},{default:f(()=>[g(a(e.$t("commons.cancel")),1)]),_:1})])])],40,ye)]),_:1})])])):d("",!0)])}}};export{ze as default};
