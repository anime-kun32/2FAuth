import{b as f,_,d as h,a0 as w,e as r,f as F,k as b,p as y,h as B,m as i,i as s,D as V}from"./app-06176200.js";import{F as v}from"./Form-87bc0477.js";/*! 2FAuth version 5.0.4 - Copyright (c) 2023 Bubka - https://github.com/Bubka/2FAuth */const R=["onSubmit"],S={__name:"RequestReset",setup(k){const o=f(),n=_().name=="webauthn.lost",t=h(new v({email:""}));function l(a){o.clear(),t.post(n?"/webauthn/lost":"/user/password/lost",{returnError:!0}).then(e=>{o.success({text:e.data.message,duration:-1})}).catch(e=>{e.response.data.requestFailed?o.alert({text:e.response.data.requestFailed,duration:-1}):e.response.status!==422&&o.error(e)})}return w(()=>{o.clear()}),(a,e)=>{const m=r("FormField"),c=r("FormButtons"),d=r("VueFooter"),p=r("FormWrapper");return F(),b(p,{title:a.$t(n?"auth.webauthn.account_recovery":"auth.forms.reset_password"),punchline:a.$t(n?"auth.webauthn.recovery_punchline":"auth.forms.reset_punchline")},{default:y(()=>[B("form",{onSubmit:V(l,["prevent"]),onKeydown:e[1]||(e[1]=u=>s(t).onKeydown(u))},[i(m,{modelValue:s(t).email,"onUpdate:modelValue":e[0]||(e[0]=u=>s(t).email=u),fieldName:"email",fieldError:s(t).errors.get("email"),label:"auth.forms.email",autofocus:""},null,8,["modelValue","fieldError"]),i(c,{submitId:"btnSendResetPwd",isBusy:s(t).isBusy,caption:a.$t(n?"auth.webauthn.send_recovery_link":"auth.forms.send_password_reset_link"),showCancelButton:!0,cancelLandingView:"login"},null,8,["isBusy","caption"])],40,R),i(d)]),_:1},8,["title","punchline"])}}};export{S as default};
