import{u as h,o as l,c,w as m,a as o,d as e,H as w,b as t,g as y,t as b,k as u,z as k,f as n,L as f,n as v}from"./app-7cfb65c9.js";import{_ as V}from"./Checkbox-1c8b0531.js";import{_ as $}from"./GuestLayout-4869af10.js";import{_ as p,a as _}from"./InputError-760d4d9c.js";import{_ as x}from"./InputLabel-98023fe9.js";import{_ as j}from"./PrimaryButton-3d24646e.js";import"./ApplicationLogo-7b42fb0a.js";import"./_plugin-vue_export-helper-c27b6911.js";import"./FooterGlobal-409d70a9.js";const B={class:"max-w-md my-12 mx-auto shadow-md p-8 rounded-lg"},L={key:0,class:"mb-4 font-medium text-sm text-green-600"},C=["onSubmit"],N=t("p",{class:"text-xs text-slate-600"},"Admin demo: admin@ordersystem.com",-1),R=t("p",{class:"text-xs text-slate-600"},"User demo: johndoe@ordersystem.com",-1),S={class:"mt-4"},U=t("p",{class:"text-xs text-slate-600"},"Admin password: admindemo1",-1),q=t("p",{class:"text-xs text-slate-600"},"Client password: johndoe1",-1),F={class:"block mt-4"},P={class:"flex items-center"},z=t("span",{class:"ml-2 text-sm text-gray-600"},"Remember me",-1),A={class:"flex items-center justify-end mt-4 gap-x-2"},O={__name:"Login",props:{canResetPassword:Boolean,status:String},setup(d){const s=h({email:"johndoe@ordersystem.com",password:"johndoe1",remember:!1}),g=()=>{s.post(route("login"),{onFinish:()=>s.reset("password")})};return(i,a)=>(l(),c($,null,{default:m(()=>[o(e(w),{title:"Log in"}),t("div",B,[d.status?(l(),y("div",L,b(d.status),1)):u("",!0),t("form",{onSubmit:k(g,["prevent"])},[t("div",null,[o(x,{for:"email",value:"Email"}),o(p,{id:"email",type:"email",class:"mt-1 block w-full",modelValue:e(s).email,"onUpdate:modelValue":a[0]||(a[0]=r=>e(s).email=r),required:"",autofocus:"",autocomplete:"username"},null,8,["modelValue"]),N,R,o(_,{class:"mt-2",message:e(s).errors.email},null,8,["message"])]),t("div",S,[o(x,{for:"password",value:"Password"}),o(p,{id:"password",type:"password",class:"mt-1 block w-full",modelValue:e(s).password,"onUpdate:modelValue":a[1]||(a[1]=r=>e(s).password=r),required:"",autocomplete:"current-password"},null,8,["modelValue"]),U,q,o(_,{class:"mt-2",message:e(s).errors.password},null,8,["message"])]),t("div",F,[t("label",P,[o(V,{name:"remember",checked:e(s).remember,"onUpdate:checked":a[2]||(a[2]=r=>e(s).remember=r)},null,8,["checked"]),z])]),t("div",A,[o(e(f),{href:i.route("register"),class:"underline text-xs md:text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"},{default:m(()=>[n(" Register ")]),_:1},8,["href"]),d.canResetPassword?(l(),c(e(f),{key:0,href:i.route("password.request"),class:"underline text-xs md:text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"},{default:m(()=>[n(" Forgot your password? ")]),_:1},8,["href"])):u("",!0),o(j,{class:v(["md:ml-4",{"opacity-25":e(s).processing}]),disabled:e(s).processing},{default:m(()=>[n(" Log in ")]),_:1},8,["class","disabled"])])],40,C)])]),_:1}))}};export{O as default};