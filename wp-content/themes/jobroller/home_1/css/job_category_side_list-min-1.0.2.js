"use strict";var JobCategoryList=JobCategoryList||{};(function(){JobCategoryList.init=function(c){var c=$.extend({},c);var b=baseURL("job_categories.html");var d=this;App.ajax({url:b,ignoreState:true,hideLoading:true,success:function(e){c.items=e;rRender(rDom(JobCategoryList.component,c),c.target)}})};JobCategoryList.component=React.createClass({onItemClick:function(b,c){if(b.id!=0){c.preventDefault();JobList.get({url:b.href,caption:b.category_name,omit:["categoryId","category_id"],jumpTo:this.props.jumpTo,target:this.props.responseTo})}},items:function(){this.props.items.forEach(function(b){b.href=baseURL("job_category-"+b.id+".html")});this.props.items.push({href:baseURL("job_category.html"),id:0,category_name:Locale.get("List All")+"..."});return this.props.items},render:function(){var b=this.props;return rDom(Component.collapseList,{icon:"th",caption:Locale.get("Job Category"),items:this.items(),collapsed:this.props.collapsed,textField:"category_name",valueField:"id",indexField:"num_pos",value:b.value,onItemClick:this.onItemClick})}});var a=function(b,d){if(b.id==0){return}d.preventDefault();var c=baseURL("job_category-"+b.id+".html");App.ajax({url:c,jumpTo:"#"+Panels.content,success:function(e){e.target="pnlJobList";e.caption=b.category_name;e.url=c;e.omit=["categoryId"];JobList.render(e)}})}})();