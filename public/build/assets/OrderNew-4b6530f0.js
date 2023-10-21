import{r as p,N as oe,u as ae,m as ne,O as ie,o as a,g as n,a as r,d as l,w as h,F as v,H as de,b as e,s as c,C as O,B as y,h as b,t as i,K as re,c as ue,f as u,n as z,y as N,j as m,v as G,L as ce}from"./app-b08cb953.js";import{_ as me}from"./GuestLayout-d434a8c6.js";import{_ as ee}from"./Accordion-95e5d14e.js";import{_ as pe}from"./Modal-37edfb16.js";import{a as C,_ as q}from"./InputError-6149185c.js";import{_ as F}from"./InputLabel-a8ad6cb0.js";import{_ as _e}from"./Checkbox-fef1d17e.js";import{_ as J}from"./PrimaryButton-2a66e53b.js";import{u as fe}from"./OrderStore-e4f8e42c.js";import"./ResponsiveNavLink-2a2ef255.js";import"./_plugin-vue_export-helper-c27b6911.js";import"./useFlash-691fd3c4.js";const ve=e("h1",{class:"font-bold sm:font-extrabold font-serif text-indigo-900 leading-8 text-xl md:text-4xl"}," Create a New Order ",-1),xe=e("p",{class:"justify-self-center text-xs lg:text-base text-gray-500 p-4"},[e("span",{class:"font-bold"},"Description: "),u("Place an order for a case study project, assignment or any task. ")],-1),be={class:"max-w-6xl mx-auto"},ge={class:"mx-3 md:mx-8 sm:m-2 p-2 border-t"},he={class:"grid lg:grid-cols-5 gap-4 lg:m-6"},ye={class:"lg:col-span-4 px-4 py-5 sm:p-6 max-w-3xl"},we={class:"md:mx-4 mb-4"},je=e("label",{class:"text-sm lg:text-base font-semibold"},[u(" Title/Topic "),e("span",{class:"text-red-500 text-xs"},"* required")],-1),ke=e("br",null,null,-1),Ce={class:"md:mx-4 my-4 pt-3 md:flex justify-between"},Oe=e("label",{for:"academic_level",class:"font-semibold text-sm lg:text-base"},[u(" Corporate/Academic Level: "),e("span",{class:"text-slate-500 font-normal text-xs"},"Select the most appropriate description of your institutional/corporate level.")],-1),Ve=e("option",{disabled:"",value:""},"Select your school level",-1),Se=["value"],Re={class:"md:mx-4 mb-4 pt-3 md:flex justify-between"},Ue=e("label",{for:"service_type",class:"font-semibold text-sm lg:text-base lg:py-2"},[u(" Type of Service: "),e("span",{class:"text-slate-500 text-xs font-normal"},"Choose the type of service you need assistance with e.g Report Writing, Case Study writing, PowerPoint presentation, etc.")],-1),Pe=e("option",{disabled:"",value:""},"Select type of service",-1),$e=["value"],qe={class:"md:mx-4 mb-4 pt-3 md:flex justify-between"},Fe=e("label",{for:"subject",class:"font-semibold text-sm"},[u(" Subject Area: "),e("span",{class:"text-slate-500 text-xs font-normal"},"Choose a discipline/subject area for this product e.g Nursing, Engineering, NGO, etc.")],-1),Le=e("option",{disabled:"",value:""},"Select your area of study",-1),Ee=["value"],Ne={class:"md:mx-4 mb-4 pt-3 flex justify-between"},De=e("label",{for:"deadline",class:"place-self-center font-semibold"},[u(" Deadline: "),e("span",{class:"text-red-500 text-xs"},"* required")],-1),Ie=e("option",{disabled:"",value:""},"Select the deadline",-1),Ae=["value"],Me={class:"md:mx-4 mb-4 pt-3 md:flex justify-between"},Te=e("label",{for:"pages",class:"font-semibold"},[u(" Pages: "),e("span",{class:"text-slate-500 text-xs font-normal"},"How many pages/words are required?")],-1),Be=e("option",{disabled:"",value:""},"Select number of Pages",-1),We=e("option",{value:0},"0 Pages/ 0 words",-1),He=["value"],ze={class:"md:mx-4 mb-4 pt-3 flex justify-between align-middle"},Ge=e("label",{for:"slides",class:"font-semibold text-sm"},[u(" Slides: "),e("span",{class:"text-slate-500 text-xs font-normal"},"Enter number of slides if needed.")],-1),Je={class:"md:mx-4 mb-4 pt-3 md:flex justify-between"},Ke=e("label",{for:"referencing_style",class:"font-semibold text-sm"},[u(" Referencing Style "),e("span",{class:"text-slate-500 text-xs font-normal"},"Choose a referencing/citation style e.g APA, OSCLA, Havard, etc.")],-1),Ye=e("option",{disabled:"",value:""},"Select Referencing Style",-1),Qe=["value"],Xe={class:"grid md:grid-cols-2 gap-4 mb-4 pt-3"},Ze={class:"mx-4"},et=e("label",{for:"spacing",class:"font-semibold text-sm"}," Line Spacing: ",-1),tt=e("option",{disabled:"",value:""},"Select line spacing",-1),st=["value"],lt={class:"mx-4 mb-4 pt-3"},ot=e("label",{for:"sources",class:"font-semibold text-sm"},[u(" Sources: "),e("span",{class:"hidden md:block text-xs font-light text-slate-600"},"No. of references/bibliography entries")],-1),at={class:"m-4"},nt=e("label",{for:"writer_category",class:"font-semibold text-sm md:text-base"}," Writer Category: ",-1),it=e("option",{disabled:"",value:""},"Select preferred Writer group",-1),dt=["value"],rt={class:"m-4"},ut=e("label",{for:"language",class:"text-sm"}," Language: ",-1),ct=e("option",{disabled:"",value:""},"Select preferred Language",-1),mt=["value"],pt={class:"pt-3 mb-8 m-4"},_t=e("label",{for:"instructions",class:"block mb-2 font-semibold"},[u(" Instructions:"),e("span",{class:"text-red-500 text-xs"},"* required")],-1),ft={class:"grid sm:grid-cols-2 md:grid-cols-3"},vt={class:"m-4"},xt=e("p",{class:"block mb-2 text-sm font-medium text-gray-600 dark:text-white"},[u(" Additional Features:"),e("span",{class:"text-gray-500 text-xs"}," Optional")],-1),bt={class:"flex justify-between"},gt={for:"{{extra.id}}",class:"text-sm"},ht=["onUpdate:modelValue","value"],yt={class:"block"},wt={class:"m-4 mx-8"},jt=e("label",{for:"files"},"Files",-1),kt={class:"mt-3 text-sm"},Ct={class:"m-4"},Ot={class:"grid mx-auto pt-4"},Vt={class:""},St=["onClick"],Rt={class:"col-span-5 lg:col-span-1 py-4 px-3"},Ut={class:"hidden md:block rounded-lg mx-auto fixed top-40 lg:top-44 right-0 lg:right-28"},Pt=e("h2",{class:"font-bold uppercase"},"Price Calculator",-1),$t={class:"flex-col divide-y items-center lg:mx-auto space-y-1.5 py-2 text-sm"},qt={key:0,class:"flex flex-row space-x-4 pt-1.5"},Ft=e("p",null,"Academic Level Rate",-1),Lt={key:1,class:"flex justify-between pt-1.5"},Et=e("p",null,"Subject Rate",-1),Nt={key:2,class:"flex justify-between pt-1.5"},Dt=e("p",null,"Service Rate",-1),It={class:"flex justify-between pt-1.5"},At=e("p",null,"Deadline Rate",-1),Mt={key:3,class:"flex justify-between pt-1.5"},Tt=e("p",null,"Pages Rate",-1),Bt={key:4,class:"flex justify-between pt-1.5"},Wt=e("p",null,"Slides Rate",-1),Ht={key:5,class:"flex justify-between pt-1.5"},zt=e("p",null,"Wr Category Rate",-1),Gt={key:6,class:"flex justify-between pt-1.5"},Jt=e("p",null,"Currency",-1),Kt={key:7,class:"flex justify-between pt-1.5"},Yt=e("p",null,"Line-spacing Rate",-1),Qt={key:8,class:"flex justify-between pt-1.5"},Xt=e("p",null,"Extra-features Rate",-1),Zt={class:"pt-1.5"},es={class:"text-xs text-red-400"},ts={key:0,class:"flex justify-between text-green-600"},ss=e("p",null,"Discount ",-1),ls={class:"font-semibold"},os={class:"flex"},as={for:"currency",class:"text-sm"},ns=e("option",{disabled:"",value:""},"Select default Currency",-1),is=["value"],ds={class:"flex justify-between pt-1.5 text-lime-500 font-semibold"},rs=e("p",null,"Total Price",-1),us={class:"rounded-lg md:hidden mx-auto max-w-sm fixed top-20 right-0"},cs={key:0},ms={key:1},ps={class:"flex-col divide-y items-center lg:mx-auto space-y-1.5 py-2"},_s={key:0,class:"flex flex-row space-x-4 pt-1.5"},fs=e("p",null,"Academic Level Rate",-1),vs={key:1,class:"flex justify-between pt-1.5"},xs=e("p",null,"Subject Rate",-1),bs={key:2,class:"flex justify-between pt-1.5"},gs=e("p",null,"Service Rate",-1),hs={class:"flex justify-between pt-1.5"},ys=e("p",null,"Deadline Rate",-1),ws={key:3,class:"flex justify-between pt-1.5"},js=e("p",null,"Pages Rate",-1),ks={key:4,class:"flex justify-between pt-1.5"},Cs=e("p",null,"Slides Rate",-1),Os={key:5,class:"flex justify-between pt-1.5"},Vs=e("p",null,"Wr Category Rate",-1),Ss={key:6,class:"flex justify-between pt-1.5"},Rs=e("p",null,"Currency",-1),Us={key:7,class:"flex justify-between pt-1.5"},Ps=e("p",null,"Line-spacing Rate",-1),$s={key:8,class:"flex justify-between pt-1.5"},qs=e("p",null,"Extra-features Rate",-1),Fs={class:"pt-1.5"},Ls={class:"text-xs text-red-400"},Es={key:0,class:"flex justify-between text-green-600"},Ns=e("p",null,"Discount ",-1),Ds={class:"font-semibold"},Is={class:"flex"},As={for:"currency",class:"text-sm"},Ms=e("option",{disabled:"",value:""},"Select default Currency",-1),Ts=["value"],Bs={class:"flex justify-between pt-1.5"},Ws=e("p",null,"Total Price",-1),Hs={class:"flex flex-wrap mx-auto justify-center my-12"},zs={class:"max-w-md my-12 mx-auto shadow-md p-8 rounded-lg"},Gs={class:"flex"},Js=e("span",{class:"text-red-500 text-xs"},"* required",-1),Ks={class:"mt-4"},Ys={class:"flex"},Qs=e("span",{class:"text-red-500 text-xs"},"* required",-1),Xs={class:"mt-4"},Zs={class:"flex"},el=e("span",{class:"text-red-500 text-xs"},"* required",-1),tl={class:"mt-4"},sl={class:"flex"},ll=e("span",{class:"text-red-500 text-xs"},"* required",-1),ol={class:"flex items-center justify-end mt-4"},al={key:0,class:"max-w-md my-12 mx-auto shadow-md p-8 rounded-lg"},nl={class:"flex"},il=e("span",{class:"text-red-500 text-xs"},"* required",-1),dl={class:"mt-4"},rl={class:"flex"},ul=e("span",{class:"text-red-500 text-xs"},"* required",-1),cl={class:"block mt-4"},ml={class:"flex items-center"},pl=e("span",{class:"ml-2 text-sm text-gray-600"},"Remember me",-1),_l={class:"flex items-center justify-end mt-4"},Vl={__name:"OrderNew",props:{order:Object,errors:Object,services:Object,levels:Object,subjects:Object,rates:Object,spacings:Object,styles:Object,writerCategories:Object,extras:Object,languages:Object,currencies:Object,discounts:Object},setup(x){const g=x;let K=fe();const Y=p({});oe(()=>{K.getFromLocal()});const w=p(null),D=p(null),V=p(null),S=p(null),R=p(null),U=p(null),P=p(null),L=p(null),$=p(null),j=p(null),k=p(null),E=p(!1),I=p(null),A=p(!1),M=p(!1),T=p(!0);function te(d){s.title=d!==null?d.title:"",s.academic_level_id=d!==null?d.academic_level_id:2,s.service_type_id=d!==null?d.service_type_id:1,s.deadline=d!==null?d.deadline:336,s.pages=d!==null?d.pages:1}let s=ae({title:"",academic_level_id:2,subject_id:1,service_type_id:1,deadline:336,pages:1,slides:0,sources:1,instructions:"",referencing_style_id:1,spacing_id:1,writer_category_id:1,discount_id:"",currency_id:2,language_id:1,extra:"",files:[],amount:"",name:"",email:"",password:"",password_confirmation:""});const B=()=>{s.post(route("orders.new"),{onError:()=>{X()},preserveScroll:!1,onFinish:()=>{s.reset(),localStorage.removeItem("newOrder")}})};ne(()=>{Y.value=JSON.parse(localStorage.getItem("newOrder")),K.getFromLocal(),te(Y.value),f()});function Q(){if(k){const d=Object.values(g.discounts).find(o=>Object.values(o).includes(k.value));d!=null?(E.value=!1,s.discount_id=Object.values(g.discounts).find(o=>Object.values(o).includes(k.value)).id,j.value=Object.values(g.discounts).find(o=>Object.values(o).includes(k.value)).rate,f()):(j.value=null,E.value=!0,f())}}function f(){let d=ie.parseInt(Object.values(g.rates).find(_=>Object.values(_).includes(s.deadline)).amount??0);D.value=d,V.value=Object.values(g.levels).find(_=>Object.values(_).includes(s.academic_level_id)).rate??0,R.value=Object.values(g.subjects).find(_=>Object.values(_).includes(s.subject_id)).rate??0,S.value=Object.values(g.services).find(_=>Object.values(_).includes(s.service_type_id)).rate??0,U.value=Object.values(g.spacings).find(_=>Object.values(_).includes(s.spacing_id)).rate??0,P.value=Object.values(g.writerCategories).find(_=>Object.values(_).includes(s.writer_category_id)).rate??0,$.value=Object.values(g.currencies).find(_=>Object.values(_).includes(s.currency_id)).rate??0,I.value=Object.values(g.currencies).find(_=>Object.values(_).includes(s.currency_id)).symbol;let o=d+d*(V.value/100)+d*(R.value/100)+d*(S.value/100)+d*(U.value/100)+d*(P.value/100),t=s.pages,H=s.slides;d=(Math.round((o*t+o*H)*100)/100).toFixed(2),d=d/$.value,w.value=d,j.value!==null?(w.value=(Math.round((d-j.value/100*d)*100)/100).toFixed(2),s.amount=w.value):(w.value=(Math.round(d*100)/100).toFixed(2),s.amount=w.value)}function X(){M.value=!1}function se(){M.value=!0}function Z(d){d==="login"?(A.value=!0,T.value=!1):(A.value=!1,T.value=!0)}const W=p(!0);function le(){W.value=!W.value}return(d,o)=>(a(),n(v,null,[r(l(de),{title:`Create A New Order Form - ${d.$page.props.websiteName}`},null,8,["title"]),r(me,null,{header:h(()=>[ve,xe]),default:h(()=>[e("section",be,[e("div",ge,[e("form",null,[e("section",he,[e("div",ye,[e("div",we,[je,ke,c(e("input",{type:"text",class:"ml-3 mt-2 border-1 p-2 w-full border-gray-400 text-sm rounded","onUpdate:modelValue":o[0]||(o[0]=t=>l(s).title=t),ref:"titleInput",name:"title",id:"title",placeholder:"Enter Topic of your Assignment/Paper",required:""},null,512),[[O,l(s).title]]),r(C,{class:"mt-2",message:l(s).errors.title},null,8,["message"])]),e("div",Ce,[Oe,c(e("select",{id:"academic_level","onUpdate:modelValue":o[1]||(o[1]=t=>l(s).academic_level_id=t),onChange:f,class:"place-self-center block md:inline-flex mt-1 ml-3 w-full md:w-1/2 rounded text-gray-900 text-sm bg-slate-100 border-slate-200",name:"academic_level",autofocus:""},[Ve,(a(!0),n(v,null,b(x.levels,t=>(a(),n("option",{value:t.id},i(t.name),9,Se))),256))],544),[[y,l(s).academic_level_id]])]),e("div",Re,[Ue,c(e("select",{id:"service_type","onUpdate:modelValue":o[2]||(o[2]=t=>l(s).service_type_id=t),onChange:f,class:"place-self-center block md:inline-flex mt-1 ml-3 w-full md:w-1/2 rounded text-gray-900 text-sm bg-slate-100 border-slate-200",name:"service_type",autofocus:""},[Pe,(a(!0),n(v,null,b(x.services,t=>(a(),n("option",{value:t.id},i(t.name),9,$e))),256))],544),[[y,l(s).service_type_id]])]),e("div",qe,[Fe,c(e("select",{id:"subject","onUpdate:modelValue":o[3]||(o[3]=t=>l(s).subject_id=t),onChange:f,class:"place-self-center block md:inline-flex mt-1 ml-3 w-full md:w-1/2 rounded text-gray-900 text-sm bg-slate-100 border-slate-200",name:"subject",autofocus:""},[Le,(a(!0),n(v,null,b(x.subjects,t=>(a(),n("option",{value:t.id},i(t.name),9,Ee))),256))],544),[[y,l(s).subject_id]])]),e("div",Ne,[De,c(e("select",{id:"deadline","onUpdate:modelValue":o[4]||(o[4]=t=>l(s).deadline=t),onChange:f,class:"place-self-center mt-1 ml-3 w-1/2 rounded text-gray-900 text-sm bg-slate-100 border-slate-200",name:"deadline",autofocus:""},[Ie,(a(!0),n(v,null,b(x.rates,t=>(a(),n("option",{value:t.hours},i(t.name),9,Ae))),256))],544),[[y,l(s).deadline]])]),e("div",Me,[Te,c(e("select",{id:"pages","onUpdate:modelValue":o[5]||(o[5]=t=>l(s).pages=t),onChange:f,class:"place-self-center block md:inline-flex mt-1.5 ml-3 w-full md:w-1/2 rounded text-gray-900 text-sm bg-slate-100 border-slate-200",name:"pages",autofocus:""},[Be,We,(a(),n(v,null,b(200,t=>e("option",{key:t,value:t},i(t)+" page(s) / "+i(t*275)+" words",9,He)),64))],544),[[y,l(s).pages]])]),e("div",ze,[Ge,c(e("input",{id:"slides","onUpdate:modelValue":o[6]||(o[6]=t=>l(s).slides=t),onChange:f,type:"number",class:"place-self-center block md:inline-flex mt-1 ml-3 w-full md:w-1/2 rounded text-gray-900 text-sm bg-slate-100 border-slate-200",name:"slides",autofocus:""},null,544),[[O,l(s).slides]])]),e("div",Je,[Ke,c(e("select",{id:"referencing_style","onUpdate:modelValue":o[7]||(o[7]=t=>l(s).referencing_style_id=t),class:"place-self-center block md:inline-flex mt-1 ml-3 w-full md:w-1/2 rounded text-gray-900 text-sm bg-slate-100 border-slate-200",name:"referencing_style",autofocus:""},[Ye,(a(!0),n(v,null,b(x.styles,t=>(a(),n("option",{value:t.id},i(t.name),9,Qe))),256))],512),[[y,l(s).referencing_style_id]])]),e("div",Xe,[e("div",Ze,[et,c(e("select",{id:"spacing","onUpdate:modelValue":o[8]||(o[8]=t=>l(s).spacing_id=t),onChange:f,class:"block w-full rounded text-gray-900 text-sm bg-slate-100 border-slate-200",name:"spacing",autofocus:""},[tt,(a(!0),n(v,null,b(x.spacings,t=>(a(),n("option",{value:t.id},i(t.name),9,st))),256))],544),[[y,l(s).spacing_id]])]),e("div",lt,[ot,c(e("input",{id:"sources","onUpdate:modelValue":o[9]||(o[9]=t=>l(s).sources=t),type:"number",class:"block rounded w-full text-gray-900 text-sm bg-slate-100 border-slate-200",name:"sources",autofocus:""},null,512),[[O,l(s).sources]])]),e("div",at,[nt,c(e("select",{id:"writer_category",class:"place-self-center block mt-1 ml-3 w-full rounded text-gray-900 text-sm bg-slate-100 border-slate-200","onUpdate:modelValue":o[10]||(o[10]=t=>l(s).writer_category_id=t),onChange:f,name:"writer_category",autofocus:""},[it,(a(!0),n(v,null,b(x.writerCategories,t=>(a(),n("option",{value:t.id},i(t.name),9,dt))),256))],544),[[y,l(s).writer_category_id]])]),e("div",rt,[ut,c(e("select",{id:"language",class:"block w-full md:w-4/5 rounded text-gray-900 text-sm border-slate-200 bg-slate-100","onUpdate:modelValue":o[11]||(o[11]=t=>l(s).language_id=t),name:"language",autofocus:""},[ct,(a(!0),n(v,null,b(x.languages,t=>(a(),n("option",{value:t.id},i(t.name),9,mt))),256))],512),[[y,l(s).language_id]])])]),e("div",pt,[_t,c(e("textarea",{id:"instructions",name:"instructions",rows:"8","onUpdate:modelValue":o[12]||(o[12]=t=>l(s).instructions=t),class:"block p-2.5 w-full text-sm md:text-md shadow-sm shadow-purple-300 bg-white rounded-lg border border-gray-200 focus:ring-blue-300 focus:border-blue-300",placeholder:"Write or Copy-and-Paste Instructions here. You can also attach additional files below ..."},`
                                `,512),[[O,l(s).instructions]]),r(C,{class:"mt-2",message:l(s).errors.instructions},null,8,["message"])]),e("div",ft,[e("div",vt,[xt,(a(!0),n(v,null,b(x.extras,t=>(a(),n("div",bt,[e("label",gt,i(t.name)+": ",1),c(e("input",{type:"checkbox",id:"{{ extra.id }}",name:"additional_features","onUpdate:modelValue":H=>l(s).extra=H,value:t.name,class:"ml-4 text-sm"},null,8,ht),[[re,l(s).extra]])]))),256))]),e("div",yt,[e("div",wt,[jt,e("div",kt,[e("input",{multiple:"",class:"text-black",type:"file",id:"files",onInput:o[13]||(o[13]=t=>l(s).files=t.target.files),name:"files[]"},null,32)])])]),e("div",Ct,[e("p",null,"Order Price: $ "+i(w.value),1),c(e("input",{hidden:"","onUpdate:modelValue":o[14]||(o[14]=t=>l(s).amount=t)},null,512),[[O,l(s).amount]])])]),e("div",Ot,[e("div",Vt,[d.$page.props.auth.user?(a(),ue(J,{key:0,onClick:B,class:z(["mx-4 px-8",{"opacity-25":l(s).processing}]),disabled:l(s).processing},{default:h(()=>[u(" Create Order ")]),_:1},8,["class","disabled"])):(a(),n("button",{key:1,onClick:N(se,["prevent"]),class:"mx-4 px-8 font-bold bg-slate-900 text-white p-2 px-4 rounded-lg"}," Place Order ",8,St))])])]),e("div",Rt,[e("div",Ut,[r(ee,{show:!0,class:"text-slate-900 text-xs bg-slate-100 bg-opacity-95 p-3 px-6"},{title:h(()=>[Pt]),content:h(()=>[e("div",$t,[V.value>0?(a(),n("div",qt,[Ft,e("p",null,i(V.value)+"%",1)])):m("",!0),R.value>0?(a(),n("div",Lt,[Et,e("p",null,i(R.value)+"%",1)])):m("",!0),S.value>0?(a(),n("div",Nt,[Dt,e("p",null,i(S.value)+"%",1)])):m("",!0),e("div",It,[At,e("p",null,"$ "+i(D.value),1)]),l(s).pages>0?(a(),n("div",Mt,[Tt,e("p",null,"price x "+i(l(s).pages),1)])):m("",!0),l(s).slides>0?(a(),n("div",Bt,[Wt,u(" = "),e("p",null,"price x "+i(l(s).slides),1)])):m("",!0),P.value>0?(a(),n("div",Ht,[zt,e("p",null,i(P.value)+"%",1)])):m("",!0),$.value!==0?(a(),n("div",Gt,[Jt,e("p",null,i($.value),1)])):m("",!0),U.value>0?(a(),n("div",Kt,[Yt,e("p",null,i(U.value)+"%",1)])):m("",!0),L.value>0?(a(),n("div",Qt,[Xt,e("p",null,"$ "+i(L.value),1)])):m("",!0),e("div",Zt,[c(e("input",{type:"text",class:"border-1 p-2 w-full text-black bg-white border-gray-400 text-sm rounded",name:"discount",id:"discount","onUpdate:modelValue":o[15]||(o[15]=t=>k.value=t),onChange:Q,placeholder:"Enter a Discount Code"},null,544),[[O,k.value]]),c(e("p",es,"Invalid/Expired code",512),[[G,E.value]]),j.value>0?(a(),n("div",ts,[ss,e("p",ls,i(j.value)+"% OFF",1)])):m("",!0)]),e("div",os,[e("div",null,[e("label",as,[u(" Currency: "),c(e("select",{id:"currency",class:"block w-full md:w-4/5 rounded text-gray-900 text-sm",name:"currency",onChange:f,"onUpdate:modelValue":o[16]||(o[16]=t=>l(s).currency_id=t),autofocus:""},[ns,(a(!0),n(v,null,b(x.currencies,t=>(a(),n("option",{value:t.id},i(t.name)+" ("+i(t.symbol)+")",9,is))),256))],544),[[y,l(s).currency_id]])])])]),e("div",ds,[rs,e("p",null,[u(i(I.value??"$")+" ",1),e("span",null,i(w.value),1)])])])]),_:1})]),e("div",us,[r(ee,{show:!1,class:"text-slate-50 text-xs lg:text-sm bg-purple-800 font-semibold bg-opacity-90 p-3 px-6"},{title:h(()=>[e("div",null,[e("h2",{onClick:le,class:"font-bold text-center text-white uppercase"},[W.value?(a(),n("span",cs,"Show")):(a(),n("span",ms,"Hide")),u(" Price Calculator")])])]),content:h(()=>[e("div",ps,[V.value>0?(a(),n("div",_s,[fs,e("p",null,i(V.value)+"%",1)])):m("",!0),R.value>0?(a(),n("div",vs,[xs,e("p",null,i(R.value)+"%",1)])):m("",!0),S.value>0?(a(),n("div",bs,[gs,e("p",null,i(S.value)+"%",1)])):m("",!0),e("div",hs,[ys,e("p",null,"$ "+i(D.value),1)]),l(s).pages>0?(a(),n("div",ws,[js,e("p",null,"price x "+i(l(s).pages),1)])):m("",!0),l(s).slides>0?(a(),n("div",ks,[Cs,u(" = "),e("p",null,"price x "+i(l(s).slides),1)])):m("",!0),P.value>0?(a(),n("div",Os,[Vs,e("p",null,i(P.value)+"%",1)])):m("",!0),$.value!==0?(a(),n("div",Ss,[Rs,e("p",null,i($.value),1)])):m("",!0),U.value>0?(a(),n("div",Us,[Ps,e("p",null,i(U.value)+"%",1)])):m("",!0),L.value>0?(a(),n("div",$s,[qs,e("p",null,"$ "+i(L.value),1)])):m("",!0),e("div",Fs,[e("div",null,[c(e("input",{type:"text",class:"border-1 p-2 w-full text-black border-gray-400 text-sm rounded",name:"discount",id:"discount","onUpdate:modelValue":o[17]||(o[17]=t=>k.value=t),onChange:Q,placeholder:"Enter a Discount Code"},null,544),[[O,k.value]]),c(e("p",Ls,"Invalid/Expired code",512),[[G,E.value]])]),j.value>0?(a(),n("div",Es,[Ns,e("p",Ds,i(j.value)+"% OFF",1)])):m("",!0)]),e("div",Is,[e("div",null,[e("label",As,[u(" Currency: "),c(e("select",{id:"currency",class:"block w-full md:w-4/5 rounded text-gray-900 text-sm",name:"currency",onChange:f,"onUpdate:modelValue":o[18]||(o[18]=t=>l(s).currency_id=t),autofocus:""},[Ms,(a(!0),n(v,null,b(x.currencies,t=>(a(),n("option",{value:t.id},i(t.name)+" ("+i(t.symbol)+")",9,Ts))),256))],544),[[y,l(s).currency_id]])])])]),e("div",Bs,[Ws,e("p",null,[u(i(I.value??"$")+" ",1),e("span",null,i(w.value),1)])])])]),_:1})])])]),r(pe,{show:M.value,onClose:X},{default:h(()=>[e("div",Hs,[e("button",{onClick:o[19]||(o[19]=N(t=>Z("login"),["prevent"])),class:"px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white hover:underline rounded-l-md"}," Login "),e("button",{onClick:o[20]||(o[20]=N(t=>Z("register"),["prevent"])),class:"px-4 py-2 bg-teal-500 hover:bg-teal-600 text-white hover:underline rounded-r-md"}," Register ")]),c(e("div",zs,[e("div",null,[e("div",null,[e("div",Gs,[r(F,{for:"name",value:"Name"}),u(),Js]),r(q,{id:"name",type:"text",class:"mt-1 block w-full",modelValue:l(s).name,"onUpdate:modelValue":o[21]||(o[21]=t=>l(s).name=t),required:"",autofocus:"",autocomplete:"name"},null,8,["modelValue"]),r(C,{class:"mt-2",message:l(s).errors.name},null,8,["message"])]),e("div",Ks,[e("div",Ys,[r(F,{for:"email",value:"Email"}),Qs]),r(q,{id:"email",type:"email",class:"mt-1 block w-full",modelValue:l(s).email,"onUpdate:modelValue":o[22]||(o[22]=t=>l(s).email=t),required:"",autocomplete:"username"},null,8,["modelValue"]),r(C,{class:"mt-2",message:l(s).errors.email},null,8,["message"])]),e("div",Xs,[e("div",Zs,[r(F,{for:"password",value:"Password"}),el]),r(q,{id:"password",type:"password",class:"mt-1 block w-full",modelValue:l(s).password,"onUpdate:modelValue":o[23]||(o[23]=t=>l(s).password=t),required:"",autocomplete:"new-password"},null,8,["modelValue"]),r(C,{class:"mt-2",message:l(s).errors.password},null,8,["message"])]),e("div",tl,[e("div",sl,[r(F,{for:"password_confirmation",value:"Confirm Password"}),ll]),r(q,{id:"password_confirmation",type:"password",class:"mt-1 block w-full",modelValue:l(s).password_confirmation,"onUpdate:modelValue":o[24]||(o[24]=t=>l(s).password_confirmation=t),required:"",autocomplete:"new-password"},null,8,["modelValue"]),r(C,{class:"mt-2",message:l(s).errors.password_confirmation},null,8,["message"])]),e("div",ol,[r(J,{onClick:B,class:z(["mx-auto py-4 lg:font-semibold bg-green-600 hover:bg-green-500 hover:underline lg:text-base text-teal-50",{"opacity-25":l(s).processing}]),disabled:l(s).processing},{default:h(()=>[u(" Register and Proceed to Checkout >>> ")]),_:1},8,["class","disabled"])])])],512),[[G,T.value===!0]]),A.value===!0?(a(),n("div",al,[e("form",null,[e("div",null,[e("div",nl,[r(F,{for:"email",value:"Email"}),il]),r(q,{id:"email",type:"email",class:"mt-1 block w-full",modelValue:l(s).email,"onUpdate:modelValue":o[25]||(o[25]=t=>l(s).email=t),required:"",autofocus:"",autocomplete:"username"},null,8,["modelValue"]),r(C,{class:"mt-2",message:l(s).errors.email},null,8,["message"])]),e("div",dl,[e("div",rl,[r(F,{for:"password",value:"Password"}),ul]),r(q,{id:"password",type:"password",class:"mt-1 block w-full",modelValue:l(s).password,"onUpdate:modelValue":o[26]||(o[26]=t=>l(s).password=t),required:"",autocomplete:"current-password"},null,8,["modelValue"]),r(C,{class:"mt-2",message:l(s).errors.password},null,8,["message"])]),e("div",cl,[e("label",ml,[r(_e,{name:"remember",checked:l(s).remember,"onUpdate:checked":o[27]||(o[27]=t=>l(s).remember=t)},null,8,["checked"]),pl])]),e("div",_l,[r(l(ce),{href:d.route("password.request"),class:"underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"},{default:h(()=>[u(" Forgot your password? ")]),_:1},8,["href"]),r(J,{class:z(["ml-4",{"opacity-25":l(s).processing}]),onClick:N(B,["prevent"]),disabled:l(s).processing},{default:h(()=>[u(" Log in ")]),_:1},8,["onClick","class","disabled"])])])])):m("",!0)]),_:1},8,["show"])])])])]),_:1})],64))}};export{Vl as default};
