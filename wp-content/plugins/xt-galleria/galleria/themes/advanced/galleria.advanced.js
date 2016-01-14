(function($) {

/*global window, jQuery, Galleria */
Galleria.addTheme({
    name: "advanced",
    author: "Galleria",
    defaults: {
        transition: "pulse",
        transitionSpeed: 400,
        imageCrop: true,
        thumbCrop: true,
        carousel: true,
        _locale: {
            show_thumbnails: "Show thumbnails",
            hide_thumbnails: "Hide thumbnails",
            play: "Play slideshow",
            pause: "Pause slideshow",
            enter_fullscreen: "Enter fullscreen",
            exit_fullscreen: "Exit fullscreen",
            popout_image: "Popout image",
            showing_image: "Showing image %s of %s"
        },
        _showFullscreen: true,
        _showPopout: true,
        _showProgress: true,
        _showTooltip: false,
    },
    init: function(t) {
        Galleria.requires(1.4, "This version of Advanced theme requires Galleria version 1.4 or later");
        this.addElement("bar", "fullscreen", "play", "popout", "thumblink", "s1", "s2", "s3", "s4", "progress");
        this.append({
            stage: "progress",
            container: ["bar", "tooltip"],
            bar: ["fullscreen", "play", "popout", "thumblink", "info", "s1", "s2", "s3", "s4"]
        });
        this.prependChild("info", "counter");
        var i = this,
            s = this.$("thumbnails-container"),
            n = this.$("thumblink"),
            o = this.$("fullscreen"),
            l = this.$("play"),
            a = this.$("popout"),
            r = this.$("bar"),
            h = this.$("progress"),
            u = t.transition,
            f = t._locale,
            c = false,
            p = false,
            d = !!t.autoplay,
            g = false,
            m = function() {
            	if(c) {
            		s.addClass('active');
            		r.addClass('thumbs-active');
            	}else{
            		s.removeClass('active');
            		r.removeClass('thumbs-active');
            	}		
            },
            b = function(e) {
                if (c && g) {
                    i.play()
                } else {
                    g = d;
                    i.pause()
                }
                
                if(c) {
            		s.removeClass('active');
            		r.removeClass('thumbs-active');
            	}else{
            		s.addClass('active');
            		r.addClass('thumbs-active');
            	}	
            	n[c ? "removeClass" : "addClass"]("open");
            	c = !c

            };
        m();
        if (t._showTooltip) {
            i.bindTooltip({
                thumblink: f.show_thumbnails,
                fullscreen: f.enter_fullscreen,
                play: function() {
                    return d ? f.pause : f.play
                },
                popout: f.popout_image,
                caption: function() {
                    var e = i.getData();
                    var t = "";
                    if (e) {
                        if (e.title && e.title.length) {
                            t += "<strong>" + e.title + "</strong>"
                        }
                        if (e.description && e.description.length) {
                            t += "<br>" + e.description
                        }
                    }
                    return t
                },
                counter: function() {
                    return f.showing_image.replace(/\%s/, i.getIndex() + 1).replace(/\%s/, i.getDataLength())
                }
            })
        }
        if (!t.showInfo) {
            this.$("info").hide()
        }
        this.bind("play", function() {
            d = true;
            l.addClass("playing")
        });
        this.bind("pause", function() {
            d = false;
            l.removeClass("playing");
            h.width(0)
        });
        if (t._showProgress) {
            this.bind("progress", function(e) {
                h.width(e.percent / 100 * this.getStageWidth())
            })
        }
        this.bind("loadstart", function(e) {
            if (!e.cached) {
                this.$("loader").show()
            }
        });
        this.bind("loadfinish", function(e) {
            h.width(0);
            this.$("loader").hide();
            this.refreshTooltip("counter", "caption")
        });
        this.bind("thumbnail", function(t) {
            $(t.thumbTarget).hover(function() {
                i.setInfo(t.thumbOrder);
                i.setCounter(t.thumbOrder)
            }, function() {
                i.setInfo();
                i.setCounter()
            }).on("click:fast", function() {
                //b()
            })
        });
        this.bind("fullscreen_enter", function(e) {
            p = true;
            i.setOptions("transition", false);
            o.addClass("open");
            r.removeClass('thumbs-active');
            this.defineTooltip("fullscreen", f.exit_fullscreen);
            if (!Galleria.TOUCH) {
                r.removeClass('thumbs-active');
            }
        });
        this.bind("fullscreen_exit", function(e) {
            p = false;
            Galleria.utils.clearTimer("bar");
            i.setOptions("transition", u);
            o.removeClass("open");
            r.removeClass('thumbs-active');
            this.defineTooltip("fullscreen", f.enter_fullscreen);
            if (!Galleria.TOUCH) {
                r.removeClass('thumbs-active');
            }
        });
        this.bind("rescale", m);
        if (!Galleria.TOUCH) {
            this.addIdleState(this.get("image-nav-left"), {
                left: -36
            });
            this.addIdleState(this.get("image-nav-right"), {
                right: -36
            })
        }
        n.on("click:fast", b);
        if (!t.thumbnails) {
            n.hide();
            l.css("left", 0);
            this.$("s2").hide();
            this.$("info").css("left", 41)
        }
        if (t._showPopout) {
            a.on("click:fast", function(e) {
                i.openLightbox();
                e.preventDefault()
            })
        } else {
            a.remove();
            if (t._showFullscreen) {
                this.$("s4").remove();
                this.$("info").css("right", 40);
                o.css("right", 0)
            }
        }
        l.on("click:fast", function() {
            if (d) {
                i.pause()
            } else {
                if (c) {
                    n.trigger("click:fast")
                }
                i.play()
            }
        });
        if (t._showFullscreen) {
            o.on("click:fast", function() {
                if (p) {
                    i.exitFullscreen()
                } else {
                    i.enterFullscreen()
                }
            })
        } else {
            o.remove();
            if (t._show_popout) {
                this.$("s4").remove();
                this.$("info").css("right", 40);
                a.css("right", 0)
            }
        }
        if (!t._showFullscreen && !t._showPopout) {
            this.$("s3,s4").remove();
            this.$("info").css("right", 10)
        }
        if (t.autoplay) {
            this.trigger("play")
        }
    }
});

}(jQuery));
