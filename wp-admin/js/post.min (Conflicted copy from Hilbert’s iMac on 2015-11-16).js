var commentsBox,WPSetThumbnailHTML,WPSetThumbnailID,WPRemoveThumbnail,wptitlehint,makeSlugeditClickable,editPermalink;makeSlugeditClickable=editPermalink=function(){},window.wp=window.wp||{},function(a){var b=!1;commentsBox={st:0,get:function(b,c){var d,e=this.st;return c||(c=20),this.st+=c,this.total=b,a("#commentsdiv .spinner").addClass("is-active"),d={action:"get-comments",mode:"single",_ajax_nonce:a("#add_comment_nonce").val(),p:a("#post_ID").val(),start:e,number:c},a.post(ajaxurl,d,function(b){return b=wpAjax.parseAjaxResponse(b),a("#commentsdiv .widefat").show(),a("#commentsdiv .spinner").removeClass("is-active"),"object"==typeof b&&b.responses[0]?(a("#the-comment-list").append(b.responses[0].data),theList=theExtraList=null,a("a[className*=':']").unbind(),void(commentsBox.st>commentsBox.total?a("#show-comments").hide():a("#show-comments").show().children("a").html(postL10n.showcomm))):1==b?void a("#show-comments").html(postL10n.endcomm):void a("#the-comment-list").append('<tr><td colspan="2">'+wpAjax.broken+"</td></tr>")}),!1}},WPSetThumbnailHTML=function(b){a(".inside","#postimagediv").html(b)},WPSetThumbnailID=function(b){var c=a('input[value="_thumbnail_id"]',"#list-table");c.size()>0&&a("#meta\\["+c.attr("id").match(/[0-9]+/)+"\\]\\[value\\]").text(b)},WPRemoveThumbnail=function(b){a.post(ajaxurl,{action:"set-post-thumbnail",post_id:a("#post_ID").val(),thumbnail_id:-1,_ajax_nonce:b,cookie:encodeURIComponent(document.cookie)},function(a){"0"==a?alert(setPostThumbnailL10n.error):WPSetThumbnailHTML(a)})},a(document).on("heartbeat-send.refresh-lock",function(b,c){var d=a("#active_post_lock").val(),e=a("#post_ID").val(),f={};e&&a("#post-lock-dialog").length&&(f.post_id=e,d&&(f.lock=d),c["wp-refresh-post-lock"]=f)}).on("heartbeat-tick.refresh-lock",function(b,c){var d,e,f;c["wp-refresh-post-lock"]&&(d=c["wp-refresh-post-lock"],d.lock_error?(e=a("#post-lock-dialog"),e.length&&!e.is(":visible")&&(wp.autosave&&(a(document).one("heartbeat-tick",function(){wp.autosave.server.suspend(),e.removeClass("saving").addClass("saved"),a(window).off("beforeunload.edit-post")}),e.addClass("saving"),wp.autosave.server.triggerSave()),d.lock_error.avatar_src&&(f=a('<img class="avatar avatar-64 photo" width="64" height="64" />').attr("src",d.lock_error.avatar_src.replace(/&amp;/g,"&")),e.find("div.post-locked-avatar").empty().append(f)),e.show().find(".currently-editing").text(d.lock_error.text),e.find(".wp-tab-first").focus())):d.new_lock&&a("#active_post_lock").val(d.new_lock))}).on("before-autosave.update-post-slug",function(){b=document.activeElement&&"title"===document.activeElement.id}).on("after-autosave.update-post-slug",function(){a("#edit-slug-box > *").length||b||a.post(ajaxurl,{action:"sample-permalink",post_id:a("#post_ID").val(),new_title:a("#title").val(),samplepermalinknonce:a("#samplepermalinknonce").val()},function(b){"-1"!=b&&a("#edit-slug-box").html(b)})})}(jQuery),function(a){function b(){c=!1,window.clearTimeout(d),d=window.setTimeout(function(){c=!0},3e5)}var c,d;a(document).on("heartbeat-send.wp-refresh-nonces",function(b,d){var e,f=a("#wp-auth-check-wrap");(c||f.length&&!f.hasClass("hidden"))&&(e=a("#post_ID").val())&&a("#_wpnonce").val()&&(d["wp-refresh-post-nonces"]={post_id:e})}).on("heartbeat-tick.wp-refresh-nonces",function(c,d){var e=d["wp-refresh-post-nonces"];e&&(b(),e.replace&&a.each(e.replace,function(b,c){a("#"+b).val(c)}),e.heartbeatNonce&&(window.heartbeatSettings.nonce=e.heartbeatNonce))}).ready(function(){b()})}(jQuery),jQuery(document).ready(function(a){function b(){var b,c,d=0,e=a("#editable-post-name"),f=e.html(),g=a("#post_name"),h=g.val(),i=a("#edit-slug-buttons"),j=i.html(),k=a("#editable-post-name-full");for(k.find("img").replaceWith(function(){return this.alt}),k=k.html(),a("#view-post-btn").hide(),i.html('<a href="#" class="save button button-small">'+postL10n.ok+'</a> <a class="cancel" href="#">'+postL10n.cancel+"</a>"),i.children(".save").click(function(){var b=e.children("input").val();return b==a("#editable-post-name-full").text()?(i.children(".cancel").click(),!1):(a.post(ajaxurl,{action:"sample-permalink",post_id:l,new_slug:b,new_title:a("#title").val(),samplepermalinknonce:a("#samplepermalinknonce").val()},function(c){var d=a("#edit-slug-box");d.html(c),d.hasClass("hidden")&&d.fadeIn("fast",function(){d.removeClass("hidden")}),i.html(j),g.val(b),a("#view-post-btn").show()}),!1)}),i.children(".cancel").click(function(){return a("#view-post-btn").show(),e.html(f),i.html(j),g.val(h),!1}),b=0;b<k.length;++b)"%"==k.charAt(b)&&d++;c=d>k.length/4?"":k,e.html('<input type="text" id="new-post-slug" value="'+c+'" />').children("input").keypress(function(a){var b=a.keyCode||0;return 13==b?(i.children(".save").click(),!1):27==b?(i.children(".cancel").click(),!1):void 0}).keyup(function(){g.val(this.value)}).focus()}var c,d,e,f,g,h="",i=a("#content"),j=a(document),k=a("#edit-slug-box"),l=a("#post_ID").val()||0,m=a("#submitpost"),n=!0,o=a("#post-visibility-select"),p=a("#timestampdiv"),q=a("#post-status-select"),r=window.navigator.platform?-1!==window.navigator.platform.indexOf("Mac"):!1;postboxes.add_postbox_toggles(pagenow),window.name="",a("#post-lock-dialog .notification-dialog").on("keydown",function(b){if(9==b.which){var c=a(b.target);c.hasClass("wp-tab-first")&&b.shiftKey?(a(this).find(".wp-tab-last").focus(),b.preventDefault()):c.hasClass("wp-tab-last")&&!b.shiftKey&&(a(this).find(".wp-tab-first").focus(),b.preventDefault())}}).filter(":visible").find(".wp-tab-first").focus(),wp.heartbeat&&a("#post-lock-dialog").length&&wp.heartbeat.interval(15),e=m.find(":submit, a.submitdelete, #post-preview").on("click.edit-post",function(b){var c=a(this);return c.hasClass("disabled")?void b.preventDefault():void(c.hasClass("submitdelete")||c.is("#post-preview")||a("form#post").off("submit.edit-post").on("submit.edit-post",function(b){b.isDefaultPrevented()||(wp.autosave&&wp.autosave.server.suspend(),"undefined"!=typeof commentReply&&commentReply.close(),n=!1,a(window).off("beforeunload.edit-post"),e.addClass("disabled"),"publish"===c.attr("id")?m.find("#major-publishing-actions .spinner").addClass("is-active"):m.find("#minor-publishing .spinner").addClass("is-active"))}))}),a("#post-preview").on("click.post-preview",function(b){var c=a(this),d=a("form#post"),e=a("input#wp-preview"),f=c.attr("target")||"wp-preview",g=navigator.userAgent.toLowerCase();b.preventDefault(),c.hasClass("disabled")||(wp.autosave&&wp.autosave.server.tempBlockSave(),e.val("dopreview"),d.attr("target",f).submit().attr("target",""),-1!==g.indexOf("safari")&&-1===g.indexOf("chrome")&&d.attr("action",function(a,b){return b+"?t="+(new Date).getTime()}),e.val(""))}),a("#title").on("keydown.editor-focus",function(a){var b;if(9===a.keyCode&&!a.ctrlKey&&!a.altKey&&!a.shiftKey){if(b="undefined"!=typeof tinymce&&tinymce.get("content"),b&&!b.isHidden())b.focus();else{if(!i.length)return;i.focus()}a.preventDefault()}}),a("#auto_draft").val()&&a("#title").blur(function(){var b;this.value&&!a("#edit-slug-box > *").length&&(a("form#post").one("submit",function(){b=!0}),window.setTimeout(function(){!b&&wp.autosave&&wp.autosave.server.triggerSave()},200))}),j.on("autosave-disable-buttons.edit-post",function(){e.addClass("disabled")}).on("autosave-enable-buttons.edit-post",function(){wp.heartbeat&&wp.heartbeat.hasConnectionError()||e.removeClass("disabled")}).on("before-autosave.edit-post",function(){a(".autosave-message").text(postL10n.savingText)}).on("after-autosave.edit-post",function(b,c){a(".autosave-message").text(c.message)}),a(window).on("beforeunload.edit-post",function(){var a="undefined"!=typeof tinymce&&tinymce.get("content");return a&&!a.isHidden()&&a.isDirty()||wp.autosave&&wp.autosave.server.postChanged()?postL10n.saveAlert:void 0}).on("unload.edit-post",function(b){n&&(b.target&&"#document"!=b.target.nodeName||a.ajax({type:"POST",url:ajaxurl,async:!1,data:{action:"wp-remove-post-lock",_wpnonce:a("#_wpnonce").val(),post_ID:a("#post_ID").val(),active_post_lock:a("#active_post_lock").val()}}))}),a("#tagsdiv-post_tag").length?window.tagBox&&window.tagBox.init():a("#side-sortables, #normal-sortables, #advanced-sortables").children("div.postbox").each(function(){return 0===this.id.indexOf("tagsdiv-")?(window.tagBox&&window.tagBox.init(),!1):void 0}),a(".categorydiv").each(function(){var b,c,d,e,f,g=a(this).attr("id");d=g.split("-"),d.shift(),e=d.join("-"),f=e+"_tab","category"==e&&(f="cats"),a("a","#"+e+"-tabs").click(function(){var b=a(this).attr("href");return a(this).parent().addClass("tabs").siblings("li").removeClass("tabs"),a("#"+e+"-tabs").siblings(".tabs-panel").hide(),a(b).show(),"#"+e+"-all"==b?deleteUserSetting(f):setUserSetting(f,"pop"),!1}),getUserSetting(f)&&a('a[href="#'+e+'-pop"]',"#"+e+"-tabs").click(),a("#new"+e).one("focus",function(){a(this).val("").removeClass("form-input-tip")}),a("#new"+e).keypress(function(b){13===b.keyCode&&(b.preventDefault(),a("#"+e+"-add-submit").click())}),a("#"+e+"-add-submit").click(function(){a("#new"+e).focus()}),b=function(b){return a("#new"+e).val()?(b.data+="&"+a(":checked","#"+e+"checklist").serialize(),a("#"+e+"-add-submit").prop("disabled",!0),b):!1},c=function(b,c){var d,f=a("#new"+e+"_parent");a("#"+e+"-add-submit").prop("disabled",!1),"undefined"!=c.parsed.responses[0]&&(d=c.parsed.responses[0].supplemental.newcat_parent)&&(f.before(d),f.remove())},a("#"+e+"checklist").wpList({alt:"",response:e+"-ajax-response",addBefore:b,addAfter:c}),a("#"+e+"-add-toggle").click(function(){return a("#"+e+"-adder").toggleClass("wp-hidden-children"),a('a[href="#'+e+'-all"]',"#"+e+"-tabs").click(),a("#new"+e).focus(),!1}),a("#"+e+"checklist, #"+e+"checklist-pop").on("click",'li.popular-category > label input[type="checkbox"]',function(){var b=a(this),c=b.is(":checked"),d=b.val();d&&b.parents("#taxonomy-"+e).length&&a("#in-"+e+"-"+d+", #in-popular-"+e+"-"+d).prop("checked",c)})}),a("#postcustom").length&&a("#the-list").wpList({addAfter:function(){a("table#list-table").show()},addBefore:function(b){return b.data+="&post_id="+a("#post_ID").val(),b}}),a("#submitdiv").length&&(c=a("#timestamp").html(),d=a("#post-visibility-display").html(),f=function(){"public"!=o.find("input:radio:checked").val()?(a("#sticky").prop("checked",!1),a("#sticky-span").hide()):a("#sticky-span").show(),"password"!=o.find("input:radio:checked").val()?a("#password-span").hide():a("#password-span").show()},g=function(){if(!p.length)return!0;var b,d,e,f,g=a("#post_status"),h=a('option[value="publish"]',g),i=a("#aa").val(),j=a("#mm").val(),k=a("#jj").val(),l=a("#hh").val(),m=a("#mn").val();return b=new Date(i,j-1,k,l,m),d=new Date(a("#hidden_aa").val(),a("#hidden_mm").val()-1,a("#hidden_jj").val(),a("#hidden_hh").val(),a("#hidden_mn").val()),e=new Date(a("#cur_aa").val(),a("#cur_mm").val()-1,a("#cur_jj").val(),a("#cur_hh").val(),a("#cur_mn").val()),b.getFullYear()!=i||1+b.getMonth()!=j||b.getDate()!=k||b.getMinutes()!=m?(p.find(".timestamp-wrap").addClass("form-invalid"),!1):(p.find(".timestamp-wrap").removeClass("form-invalid"),b>e&&"future"!=a("#original_post_status").val()?(f=postL10n.publishOnFuture,a("#publish").val(postL10n.schedule)):e>=b&&"publish"!=a("#original_post_status").val()?(f=postL10n.publishOn,a("#publish").val(postL10n.publish)):(f=postL10n.publishOnPast,a("#publish").val(postL10n.update)),d.toUTCString()==b.toUTCString()?a("#timestamp").html(c):a("#timestamp").html("\n"+f+" <b>"+postL10n.dateFormat.replace("%1$s",a('option[value="'+j+'"]',"#mm").attr("data-text")).replace("%2$s",parseInt(k,10)).replace("%3$s",i).replace("%4$s",("00"+l).slice(-2)).replace("%5$s",("00"+m).slice(-2))+"</b> "),"private"==o.find("input:radio:checked").val()?(a("#publish").val(postL10n.update),0===h.length?g.append('<option value="publish">'+postL10n.privatelyPublished+"</option>"):h.html(postL10n.privatelyPublished),a('option[value="publish"]',g).prop("selected",!0),a("#misc-publishing-actions .edit-post-status").hide()):("future"==a("#original_post_status").val()||"draft"==a("#original_post_status").val()?h.length&&(h.remove(),g.val(a("#hidden_post_status").val())):h.html(postL10n.published),g.is(":hidden")&&a("#misc-publishing-actions .edit-post-status").show()),a("#post-status-display").html(a("option:selected",g).text()),"private"==a("option:selected",g).val()||"publish"==a("option:selected",g).val()?a("#save-post").hide():(a("#save-post").show(),"pending"==a("option:selected",g).val()?a("#save-post").show().val(postL10n.savePending):a("#save-post").show().val(postL10n.saveDraft)),!0)},a("#visibility .edit-visibility").click(function(){return o.is(":hidden")&&(f(),o.slideDown("fast",function(){o.find('input[type="radio"]').first().focus()}),a(this).hide()),!1}),o.find(".cancel-post-visibility").click(function(b){o.slideUp("fast"),a("#visibility-radio-"+a("#hidden-post-visibility").val()).prop("checked",!0),a("#post_password").val(a("#hidden-post-password").val()),a("#sticky").prop("checked",a("#hidden-post-sticky").prop("checked")),a("#post-visibility-display").html(d),a("#visibility .edit-visibility").show().focus(),g(),b.preventDefault()}),o.find(".save-post-visibility").click(function(b){o.slideUp("fast"),a("#visibility .edit-visibility").show().focus(),g(),"public"!=o.find("input:radio:checked").val()&&a("#sticky").prop("checked",!1),h=a("#sticky").prop("checked")?"Sticky":"",a("#post-visibility-display").html(postL10n[o.find("input:radio:checked").val()+h]),b.preventDefault()}),o.find("input:radio").change(function(){f()}),p.siblings("a.edit-timestamp").click(function(b){p.is(":hidden")&&(p.slideDown("fast",function(){a("input, select",p.find(".timestamp-wrap")).first().focus()}),a(this).hide()),b.preventDefault()}),p.find(".cancel-timestamp").click(function(b){p.slideUp("fast").siblings("a.edit-timestamp").show().focus(),a("#mm").val(a("#hidden_mm").val()),a("#jj").val(a("#hidden_jj").val()),a("#aa").val(a("#hidden_aa").val()),a("#hh").val(a("#hidden_hh").val()),a("#mn").val(a("#hidden_mn").val()),g(),b.preventDefault()}),p.find(".save-timestamp").click(function(a){g()&&(p.slideUp("fast"),p.siblings("a.edit-timestamp").show().focus()),a.preventDefault()}),a("#post").on("submit",function(b){g()||(b.preventDefault(),p.show(),wp.autosave&&wp.autosave.enableButtons(),a("#publishing-action .spinner").removeClass("is-active"))}),q.siblings("a.edit-post-status").click(function(b){q.is(":hidden")&&(q.slideDown("fast",function(){q.find("select").focus()}),a(this).hide()),b.preventDefault()}),q.find(".save-post-status").click(function(a){q.slideUp("fast").siblings("a.edit-post-status").show().focus(),g(),a.preventDefault()}),q.find(".cancel-post-status").click(function(b){q.slideUp("fast").siblings("a.edit-post-status").show().focus(),a("#post_status").val(a("#hidden_post_status").val()),g(),b.preventDefault()})),k.length&&k.on("click",function(c){var d=a(c.target);(d.is("#editable-post-name")||d.hasClass("edit-slug"))&&b()}),wptitlehint=function(b){b=b||"title";var c=a("#"+b),d=a("#"+b+"-prompt-text");""===c.val()&&d.removeClass("screen-reader-text"),d.click(function(){a(this).addClass("screen-reader-text"),c.focus()}),c.blur(function(){""===this.value&&d.removeClass("screen-reader-text")}).focus(function(){d.addClass("screen-reader-text")}).keydown(function(b){d.addClass("screen-reader-text"),a(this).unbind(b)})},wptitlehint(),function(){function b(a){h.hasClass("wp-editor-expand")||(f?d.theme.resizeTo(null,e+a.pageY):i.height(Math.max(50,e+a.pageY)),a.preventDefault())}function c(){var b,c;h.hasClass("wp-editor-expand")||(f?(d.focus(),c=parseInt(a("#wp-content-editor-container .mce-toolbar-grp").height(),10),(10>c||c>200)&&(c=30),b=parseInt(a("#content_ifr").css("height"),10)+c-28):(i.focus(),b=parseInt(i.css("height"),10)),j.off(".wp-editor-resize"),b&&b>50&&5e3>b&&setUserSetting("ed_size",b))}var d,e,f,g=a("#post-status-info"),h=a("#postdivrich");return!i.length||"ontouchstart"in window?void a("#content-resize-handle").hide():void g.on("mousedown.wp-editor-resize",function(g){"undefined"!=typeof tinymce&&(d=tinymce.get("content")),d&&!d.isHidden()?(f=!0,e=a("#content_ifr").height()-g.pageY):(f=!1,e=i.height()-g.pageY,i.blur()),j.on("mousemove.wp-editor-resize",b).on("mouseup.wp-editor-resize mouseleave.wp-editor-resize",c),g.preventDefault()}).on("mouseup.wp-editor-resize",c)}(),"undefined"!=typeof tinymce&&a("#post-formats-select input.post-format").on("change.set-editor-class",function(){var b,c,d=this.id;d&&a(this).prop("checked")&&(b=tinymce.get("content"))&&(c=b.getBody(),c.className=c.className.replace(/\bpost-format-[^ ]+/,""),b.dom.addClass(c,"post-format-0"==d?"post-format-standard":d),a(document).trigger("editor-classchange"))}),i.on("keydown.wp-autosave",function(a){if(83===a.which){if(a.shiftKey||a.altKey||r&&(!a.metaKey||a.ctrlKey)||!r&&!a.ctrlKey)return;wp.autosave&&wp.autosave.server.triggerSave(),a.preventDefault()}})}),function(a,b){a(function(){function c(){var a,c;a=!d||d.isHidden()?e.val():d.getContent({format:"raw"}),c=b.count(a),c!==g&&f.text(c),g=c}var d,e=a("#content"),f=a("#wp-word-count").find(".word-count"),g=0;a(document).on("tinymce-editor-init",function(a,b){"content"===b.id&&(d=b,b.on("nodechange keyup",_.debounce(c,1e3)))}),e.on("input keyup",_.debounce(c,1e3)),c()})}(jQuery,new wp.utils.WordCounter);