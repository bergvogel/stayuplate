jQuery(document).ready(function(a){postboxes.add_postbox_toggles("comment");var b=a("#timestampdiv"),c=a("#timestamp"),d=c.html(),e=b.find(".timestamp-wrap"),f=b.siblings("a.edit-timestamp");f.click(function(c){b.is(":hidden")&&(b.slideDown("fast",function(){a("input, select",e).first().focus()}),a(this).hide()),c.preventDefault()}),b.find(".cancel-timestamp").click(function(e){f.show().focus(),b.slideUp("fast"),a("#mm").val(a("#hidden_mm").val()),a("#jj").val(a("#hidden_jj").val()),a("#aa").val(a("#hidden_aa").val()),a("#hh").val(a("#hidden_hh").val()),a("#mn").val(a("#hidden_mn").val()),c.html(d),e.preventDefault()}),b.find(".save-timestamp").click(function(d){var g=a("#aa").val(),h=a("#mm").val(),i=a("#jj").val(),j=a("#hh").val(),k=a("#mn").val(),l=new Date(g,h-1,i,j,k);return d.preventDefault(),l.getFullYear()!=g||1+l.getMonth()!=h||l.getDate()!=i||l.getMinutes()!=k?void e.addClass("form-invalid"):(e.removeClass("form-invalid"),c.html(commentL10n.submittedOn+" <b>"+commentL10n.dateFormat.replace("%1$s",a('option[value="'+h+'"]',"#mm").attr("data-text")).replace("%2$s",parseInt(i,10)).replace("%3$s",g).replace("%4$s",("00"+j).slice(-2)).replace("%5$s",("00"+k).slice(-2))+"</b> "),f.show().focus(),void b.slideUp("fast"))})});