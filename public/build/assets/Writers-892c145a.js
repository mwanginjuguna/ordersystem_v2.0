import{r as i,u as V,o as _,c as W,w as a,a as s,b as e,d as o,e as $,f as n,n as A,g as y,h as I,t as f,F as N,i as j}from"./app-b08cb953.js";import{_ as B}from"./BaseLayout-d17fc57f.js";import{O as F}from"./OrdersCard-f81b8c3d.js";import{_ as O}from"./Panel-66439d9b.js";import{_ as S}from"./Modal-37edfb16.js";import{_ as E}from"./PrimaryButton-2a66e53b.js";import{_ as K}from"./SecondaryButton-c43bd284.js";import{_ as g,a as x}from"./InputError-6149185c.js";import{_ as h}from"./InputLabel-a8ad6cb0.js";import"./NavLink-aa743517.js";import"./ResponsiveNavLink-2a2ef255.js";import"./_plugin-vue_export-helper-c27b6911.js";import"./Accordion-95e5d14e.js";import"./FlashMessage-dfc414e0.js";const T=e("h1",{class:"font-bold sm:font-extrabold text-indigo-900 leading-8 text-center text-xl md:text-4xl"}," Writer Categories or groups ",-1),U=e("p",{class:"justify-self-center text-center text-xs text-gray-500 p-4 border-b border-purple-500"},[e("span",{class:"font-bold"},"About: "),n("All Customize Writers and Writer Categories. ")],-1),z={class:"grid grid-cols-2"},D={class:"col-span-2 flex justify-between mx-6"},L=e("p",{class:"lg:text-indigo-900"},"Writer groups",-1),P={class:"mt-4 py-4 px-5"},R=e("h2",{class:"text-lg font-medium text-gray-900"}," Add a new WriterCategory ",-1),q=e("p",{class:"mt-1 text-sm text-gray-600"}," Add a writer category e.g. Expert, Pro, Intermediate. The rates expect a percentage number e.g 30 for 30% increase on the total order price. ",-1),G={class:"mt-6"},H={class:"mt-6"},J={class:"mt-6"},M={class:"mt-6 flex justify-end"},Q={class:"p-3 lg:py-10 lg:px-8 m-2 md:grid md:grid-cols-3 lg:mx-8 lg:my-4"},X=e("div",{class:"text-center underline col-span-3 lg:col-end-3"},[e("h3",{class:"font-semibold"},"All Writer Categories")],-1),Y={class:"md:col-span-2 lg:col-span-3 col-end-3 text-sm md:text-base space-y-6"},Z={class:"flex justify-between md:max-w-2/3 mx-auto border-b"},ee={class:"text-gray-500 lg:text-sm text-xs"},te={class:"text-xs"},se={class:"p-2"},oe=["onClick","disabled"],ve={__name:"Writers",props:{writerCategories:Object,errors:Object},setup(C){let d=i(!1);const c=i(null),m=i(null),u=i(null),t=V({name:"",rate:"",description:""}),v=()=>{t.post(route("admin.writer_categories.add"),{preserveScroll:!0,onSuccess:()=>p(),onError:()=>c.value.focus()&&m.value.focus()&&u.value.focus(),onFinish:()=>t.reset()})},w=b=>{confirm("Are you sure?")&&t.delete(route("admin.writer_category",b))};function k(){d.value=!0,j(()=>c.value.focus()&&m.value.focus()&&u.value.focus())}function p(){d.value=!1,t.reset()}return(b,l)=>(_(),W(B,null,{header:a(()=>[T,U]),default:a(()=>[s(F,null,{default:a(()=>[e("div",z,[e("div",D,[L,e("button",{class:"p-2 px-4 mr-12 bg-purple-200 text-slate-900 hover:underline border border-slate-700 rounded hover:bg-purple-300 hover:text-slate-800 active:bg-purple-400 active:ring-slate-900 transition ease-in-out hover:duration-500 active:duration-500",onClick:k},"Add New"),s(S,{show:o(d),onClose:p},{default:a(()=>[e("div",P,[R,q,e("div",G,[s(h,{for:"name"}),s(g,{id:"name",ref_key:"nameInput",ref:c,modelValue:o(t).name,"onUpdate:modelValue":l[0]||(l[0]=r=>o(t).name=r),type:"text",class:"mt-1 block w-3/4",placeholder:"Writer Category Name"},null,8,["modelValue"]),s(x,{message:o(t).errors.name,class:"mt-2"},null,8,["message"])]),e("div",H,[s(h,{for:"rate"}),s(g,{id:"rate",ref_key:"rateInput",ref:m,modelValue:o(t).rate,"onUpdate:modelValue":l[1]||(l[1]=r=>o(t).rate=r),type:"text",class:"mt-1 block w-3/4",placeholder:"Category rate eg. 20 for 20%"},null,8,["modelValue"]),s(x,{message:o(t).errors.rate,class:"mt-2"},null,8,["message"])]),e("div",J,[s(h,{for:"description"}),s(g,{id:"description",ref_key:"descriptionInput",ref:u,modelValue:o(t).description,"onUpdate:modelValue":l[2]||(l[2]=r=>o(t).description=r),type:"text",class:"mt-1 block w-3/4",placeholder:"Writer Category description.",onKeyup:$(v,["enter"])},null,8,["modelValue","onKeyup"]),s(x,{message:o(t).errors.description,class:"mt-2"},null,8,["message"])]),e("div",M,[s(K,{onClick:p},{default:a(()=>[n(" Cancel ")]),_:1}),s(E,{onClick:v,class:A(["ml-4",{"opacity-25":o(t).processing}]),disabled:o(t).processing},{default:a(()=>[n(" Add New ")]),_:1},8,["class","disabled"])])])]),_:1},8,["show"])]),s(O,{class:"col-span-2"},{default:a(()=>[e("div",null,[e("div",Q,[X,e("div",Y,[(_(!0),y(N,null,I(C.writerCategories,r=>(_(),y("div",Z,[e("div",null,[e("p",null,[n(f(r.name)+": ",1),e("span",ee,f(r.description),1)]),e("p",te,[n("Rate: "),e("span",null,f(r.rate)+"%",1)])]),e("div",se,[e("button",{onClick:re=>w(r.id),disabled:o(t).processing,class:"text-red-400 hover:text-red-500 underline mx-2"},"Delete",8,oe)])]))),256))])])])]),_:1})])]),_:1})]),_:1}))}};export{ve as default};
