/*
 * 'Highly configurable' mutable plugin boilerplate
 * Author: @markdalgleish
 * Further changes, comments: @addyosmani
 * Licensed under the MIT license
 */

// Note that with this pattern, as per Alex Sexton's, the plugin logic
// hasn't been nested in a jQuery plugin. Instead, we just use
// jQuery for its instantiation.

(function($, window, document, undefined) {

    // our plugin constructor
    var Plugin = function(elem, options) {
        this.elem = elem;
        this.$elem = $(elem);
        this.options = options;

		var ref = this;
		$(document).on('click', '.page-link', function() {
			if (ref.config.processing) return;
			//if($(this).text() == "Previous" || $(this).text() == "Next") return;
			if ($(this).text() == "Next") {
				++ref.config.page;

			} else if ($(this).text() == "Previous") {
				--ref.config.page;
			} else {
				ref.config.page = $(this).text();
			}
			ref.config.processing = true;
			ref.requestData();
		});
		
        // This next line takes advantage of HTML5 data attributes
        // to support customization of the plugin on a per-element
        // basis. For example,
        // <div class=item' data-plugin-options='{"message":"Goodbye World!"}'></div>
        this.metadata = this.$elem.data('plugin-options');
    };

    // the plugin prototype
    Plugin.prototype = {
        defaults: {
            limit: 10,
            data: [],
            data_hash: "",
            page: 1,
            url: "",
            cols: null,
            ref: "",
            pageContainer: "",
            search: "",
            is_search: false,
            threshold: 100,
            processing: false,
            total: 100,
            type: null,
            onBeforeRequest: function() {},
            onSuccessRequest: function() {},
            render: function() {},
            loaderContainer: '',
            loader: `<svg class="circular-static d-flex" viewBox="25 25 50 50">
    <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle> 
  </svg>`,
            pageLoader: `<svg class="circular d-flex" viewBox="25 25 50 50">
    <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle> 
  </svg>`
        },

        table: function() {
            // Introduce defaults that can be extended either 
            // globally or using an object literal.

            this.config = $.extend({}, this.defaults, this.options,
                this.metadata);

            // Sample usage:
            // Set the message per instance:
            // $('#elem').plugin({ message: 'Goodbye World!'});
            // or
            // var p = new Plugin(document.getElementById('elem'), 
            // { message: 'Goodbye World!'}).init()
            // or, set the global default message:
            // Plugin.defaults.message = 'Goodbye World!'
            this.config.type = 'pagination';
            if (this.config.search != null) {
                this.config.is_search = true;
            }

            this.requestData();
            return this;
        },

        scroll: function() {
            this.config = $.extend({}, this.defaults, this.options,
                this.metadata);
			
			this.config.type = 'infinity_scroll';
			
            this.requestData();
			this.registerScrollEvent();
            return this;
        },

        requestData: function() {
            this.config.onBeforeRequest();
            var that = this;
            var ref = that.config;
			
			//if(this.config.processing) return;
			
            $.ajax({
                url: this.config.url,
                type: "GET",
                data: {
                    limit: this.config.limit,
                    page: this.config.page,
                    search: this.config.search
                },
                success: function(res) {
                    //console.log(res);
					var template = ``;
                    if (ref.type == "pagination") {
                        ref.data = res.data;

                        ref.data_hash = btoa(unescape(encodeURIComponent(JSON.stringify(ref.data))));
                        var template = ref.render(res.data,res);
                        ref.processing = false;
                        that.generatePagination(ref.page, res.total);
                        that.$elem.html(template);
                    } else {
						
						ref.data = res.data;
                        if (ref.data_hash != "") {
                            ref.data = JSON.parse(unescape(encodeURIComponent(atob(ref.data_hash))));
                        }

                        if (res.data.length <= 0) {
                            ref.data_hash = "";
                        }

                        if (ref.is_search) {
                            ref.data = res.data;
                            ref.data_hash = btoa(unescape(encodeURIComponent(JSON.stringify(ref.data))));
                            template = ref.render(res.data,res);
                            ref.total = res.total;
                            ref.is_search = false;
						} else {
                            ref.total = res.total;
                            ref.data = ref.data.concat(res.data);
                            ref.data_hash = btoa(unescape(encodeURIComponent(JSON.stringify(ref.data))));
                            template = ref.render(res.data,res);
                        }
						
						that.$elem.append(template);

                        if (ref.loaderContainer == '') {
                            that.$elem.after(``);
                        } else {
                            $(ref.loaderContainer).html(``);
                        }

                        setTimeout(function() {
                            ref.processing = false;
                        }, 100);
                    }
                    ref.onSuccessRequest();
					return 'success';
                }
            });
        },

        generatePagination: function(current, max) {
            if (max == 0) {
                $(this.config.pageContainer).html("");
                return;
            }
            current = parseInt(current);
            $(this.config.pageContainer).html(``);

            var left = 3;
            var right = 3;

            var prevStat = (current == 1) ? "disabled" : "";
            var nextStat = (current == max) ? "disabled" : "";
            $(this.config.pageContainer).prepend(`<li class="page-item page-item-prev ${prevStat}">
          <a class="page-link" tabindex="-1">Previous</a>
      </li>`);
            $(".page-item-prev").after(`<li class="page-item active"><a class="page-link">${this.config.page}</a></li>`);

            for (var i = 0; i < 6; i++) {
                if (i % 2 == 0) {
                    if (current + right > max) {
                        right--;
                        continue;
                    }
                    $(".page-item.active").after(`<li class="page-item"><a class="page-link">${current+right}</a></li>`);
                    right--;
                } else {
                    if (current - left < 1) {
                        left--;
                        continue;
                    }
                    $(".page-item.active").before(`<li class="page-item"><a class="page-link">${current-left}</a></li>`);
                    left--;
                }
            }

            $(this.config.pageContainer).append(`<li class="page-item page-item-next ${nextStat}">
            <a class="page-link">Next</a>
        </li>`);
        },

        registerScrollEvent: function() {
			var that = this;
            var ref = that.config;
            $(document).scroll(function() {
				if(ref.processing) return;
                if (ref.page >= ref.total) return;
				if($(window).scrollTop() + $(window).height() < 1400) return; 

                if ($(window).scrollTop() + $(window).height() > $(document).height() - ref.threshold) {
                    ref.page = ref.page + 1;
                    ref.processing = true;
                    if (ref.loaderContainer == '') {
                        that.$elem.after(ref.loader);
                    } else {
                        $(ref.loaderContainer).html(ref.loader);
                    }
                    that.requestData();
                }
            });
        },

        searchQuery: function(search) {
            this.config.search = search;
            this.config.is_search = true;
            this.$elem.html(``);
            //console.log(this.config.url);
            this.requestData();
        },

        fetch: function(index) {
            var tmp = JSON.parse(atob(this.config.data_hash));
            return tmp[index];
        },

        dataFind: function(key, value) {
            var tmp = JSON.parse(atob(this.config.data_hash));
            for (var i = 0; i < tmp.length; i++) {
                if (value == tmp[i][key]) {
                    return tmp[i];
                }
            }

            return [];
        },

        dataPrepend: function(t) {
            this.$elem.prepend(t.template);
            var tmp = JSON.parse(atob(this.config.data_hash));
            tmp.unshift(t.data);
            this.config.data_hash = btoa(JSON.stringify(tmp));
        },

        dataAppend: function(t) {
            this.$elem.append(t.template);
            var tmp = JSON.parse(atob(this.config.data_hash));
            tmp.push(t.data);
            this.config.data_hash = btoa(JSON.stringify(tmp));
        },

        dataReplace: function(t) {
            var tmp = JSON.parse(atob(this.config.data_hash));
            tmp[t.index] = t.data;
            this.config.data_hash = btoa(JSON.stringify(tmp));
            this.$elem.children().eq(t.index).replaceWith(t.template);
        },

        dataReplaceByKey: function(key, value) {
            var tmp = JSON.parse(atob(this.config.data_hash));
            for (var i = 0; i < tmp.length; i++) {
                if (value == tmp[i][key]) {
                    tmp[i] = value.data;
                    this.$elem.children().eq(value.index).replaceWith(value.template);
                }
            }

            this.config.data_hash = btoa(JSON.stringify(tmp));
        },

        dataRemove: function(index) {
            var tmp = JSON.parse(atob(this.config.data_hash));
            tmp.splice(index, 1);
            this.config.data_hash = btoa(JSON.stringify(tmp));
            this.$elem.children().eq(index).remove();
        },

        dataRemoveByKey: function(key, value) {
            var tmp = JSON.parse(atob(this.config.data_hash));
            for (var i = 0; i < tmp.length; i++) {
                if (value == tmp[i][key]) {
                    tmp.splice(i, 1);
                    this.$elem.children().eq(i).remove();
                }
            }
            this.config.data_hash = btoa(JSON.stringify(tmp));
        }
    }

    Plugin.defaults = Plugin.prototype.defaults;

    $.fn.plugin = function(options) {
        return this.each(function() {
            new Plugin(this, options).init();
        });
    };

    $.fn.initTable = function(options) {
        /* return this.each(function() {
            new Plugin(this, options).table();
        }); */
        return new Plugin(this, options).table();
    };

    $.fn.infiniteScroll = function(options) {
        return new Plugin(this, options).scroll();
    };

    //optional: window.Plugin = Plugin;

})(jQuery, window, document);