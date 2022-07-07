/*!
 Buttons for DataTables 2.1.0
 ©2016-2021 SpryMedia Ltd - datatables.net/license
*/
(function (f) { "function" === typeof define && define.amd ? define(["jquery", "datatables.net"], function (C) { return f(C, window, document) }) : "object" === typeof exports ? module.exports = function (C, x) { C || (C = window); x && x.fn.dataTable || (x = require("datatables.net")(C, x).$); return f(x, C, C.document) } : f(jQuery, window, document) })(function (f, C, x, q) {
    function I(a, b, c) { f.fn.animate ? a.stop().fadeIn(b, c) : (a.css("display", "block"), c && c.call(a)) } function J(a, b, c) { f.fn.animate ? a.stop().fadeOut(b, c) : (a.css("display", "none"), c && c.call(a)) }
    function L(a, b) { a = new u.Api(a); b = b ? b : a.init().buttons || u.defaults.buttons; return (new v(a, b)).container() } var u = f.fn.dataTable, O = 0, P = 0, y = u.ext.buttons, v = function (a, b) {
        if (!(this instanceof v)) return function (c) { return (new v(c, a)).container() }; "undefined" === typeof b && (b = {}); !0 === b && (b = {}); Array.isArray(b) && (b = { buttons: b }); this.c = f.extend(!0, {}, v.defaults, b); b.buttons && (this.c.buttons = b.buttons); this.s = { dt: new u.Api(a), buttons: [], listenKeys: "", namespace: "dtb" + O++ }; this.dom = {
            container: f("<" + this.c.dom.container.tag +
                "/>").addClass(this.c.dom.container.className)
        }; this._constructor()
    }; f.extend(v.prototype, {
        action: function (a, b) { a = this._nodeToButton(a); if (b === q) return a.conf.action; a.conf.action = b; return this }, active: function (a, b) { var c = this._nodeToButton(a); a = this.c.dom.button.active; c = f(c.node); if (b === q) return c.hasClass(a); c.toggleClass(a, b === q ? !0 : b); return this }, add: function (a, b, c) {
            var d = this.s.buttons; if ("string" === typeof b) {
                b = b.split("-"); var k = this.s; d = 0; for (var e = b.length - 1; d < e; d++)k = k.buttons[1 * b[d]]; d =
                    k.buttons; b = 1 * b[b.length - 1]
            } this._expandButton(d, a, a !== q ? a.split : q, (a === q || a.split === q || 0 === a.split.length) && k !== q, !1, b); c !== q && !0 !== c || this._draw(); return this
        }, collectionRebuild: function (a, b) { a = this._nodeToButton(a); if (b !== q) { var c; for (c = a.buttons.length - 1; 0 <= c; c--)this.remove(a.buttons[c].node); for (c = 0; c < b.length; c++) { var d = b[c]; this._expandButton(a.buttons, d, d !== q && d.config !== q && d.config.split !== q, !0, d.parentConf !== q && d.parentConf.split !== q, c, d.parentConf) } } this._draw(a.collection, a.buttons) },
        container: function () { return this.dom.container }, disable: function (a) { a = this._nodeToButton(a); f(a.node).addClass(this.c.dom.button.disabled).attr("disabled", !0); return this }, destroy: function () { f("body").off("keyup." + this.s.namespace); var a = this.s.buttons.slice(), b; var c = 0; for (b = a.length; c < b; c++)this.remove(a[c].node); this.dom.container.remove(); a = this.s.dt.settings()[0]; c = 0; for (b = a.length; c < b; c++)if (a.inst === this) { a.splice(c, 1); break } return this }, enable: function (a, b) {
            if (!1 === b) return this.disable(a);
            a = this._nodeToButton(a); f(a.node).removeClass(this.c.dom.button.disabled).removeAttr("disabled"); return this
        }, index: function (a, b, c) { b || (b = "", c = this.s.buttons); for (var d = 0, k = c.length; d < k; d++) { var e = c[d].buttons; if (c[d].node === a) return b + d; if (e && e.length && (e = this.index(a, d + "-", e), null !== e)) return e } return null }, name: function () { return this.c.name }, node: function (a) { if (!a) return this.dom.container; a = this._nodeToButton(a); return f(a.node) }, processing: function (a, b) {
            var c = this.s.dt, d = this._nodeToButton(a);
            if (b === q) return f(d.node).hasClass("processing"); f(d.node).toggleClass("processing", b); f(c.table().node()).triggerHandler("buttons-processing.dt", [b, c.button(a), c, f(a), d.conf]); return this
        }, remove: function (a) {
            var b = this._nodeToButton(a), c = this._nodeToHost(a), d = this.s.dt; if (b.buttons.length) for (var k = b.buttons.length - 1; 0 <= k; k--)this.remove(b.buttons[k].node); b.conf.destroying = !0; b.conf.destroy && b.conf.destroy.call(d.button(a), d, f(a), b.conf); this._removeKey(b.conf); f(b.node).remove(); a = f.inArray(b,
                c); c.splice(a, 1); return this
        }, text: function (a, b) { var c = this._nodeToButton(a); a = this.c.dom.collection.buttonLiner; a = c.inCollection && a && a.tag ? a.tag : this.c.dom.buttonLiner.tag; var d = this.s.dt, k = f(c.node), e = function (h) { return "function" === typeof h ? h(d, k, c.conf) : h }; if (b === q) return e(c.conf.text); c.conf.text = b; a ? k.children(a).eq(0).filter(":not(.dt-down-arrow)").html(e(b)) : k.html(e(b)); return this }, _constructor: function () {
            var a = this, b = this.s.dt, c = b.settings()[0], d = this.c.buttons; c._buttons || (c._buttons =
                []); c._buttons.push({ inst: this, name: this.c.name }); for (var k = 0, e = d.length; k < e; k++)this.add(d[k]); b.on("destroy", function (h, l) { l === c && a.destroy() }); f("body").on("keyup." + this.s.namespace, function (h) { if (!x.activeElement || x.activeElement === x.body) { var l = String.fromCharCode(h.keyCode).toLowerCase(); -1 !== a.s.listenKeys.toLowerCase().indexOf(l) && a._keypress(l, h) } })
        }, _addKey: function (a) { a.key && (this.s.listenKeys += f.isPlainObject(a.key) ? a.key.key : a.key) }, _draw: function (a, b) {
            a || (a = this.dom.container, b = this.s.buttons);
            a.children().detach(); for (var c = 0, d = b.length; c < d; c++)a.append(b[c].inserter), a.append(" "), b[c].buttons && b[c].buttons.length && this._draw(b[c].collection, b[c].buttons)
        }, _expandButton: function (a, b, c, d, k, e, h) {
            var l = this.s.dt, m = 0, p = Array.isArray(b) ? b : [b]; b === q && (p = Array.isArray(c) ? c : [c]); c = 0; for (var r = p.length; c < r; c++) {
                var n = this._resolveExtends(p[c]); if (n) if (b = n.config !== q && n.config.split ? !0 : !1, Array.isArray(n)) this._expandButton(a, n, g !== q && g.conf !== q ? g.conf.split : q, d, h !== q && h.split !== q, e, h); else {
                    var g =
                        this._buildButton(n, d, n.split !== q || n.config !== q && n.config.split !== q, k); if (g) {
                            e !== q && null !== e ? (a.splice(e, 0, g), e++) : a.push(g); if (g.conf.buttons || g.conf.split) {
                                g.collection = f("<" + (b ? this.c.dom.splitCollection.tag : this.c.dom.collection.tag) + "/>"); g.conf._collection = g.collection; if (g.conf.split) for (var t = 0; t < g.conf.split.length; t++)"object" === typeof g.conf.split[t] && (g.conf.split[c].parent = h, g.conf.split[t].collectionLayout === q && (g.conf.split[t].collectionLayout = g.conf.collectionLayout), g.conf.split[t].dropup ===
                                    q && (g.conf.split[t].dropup = g.conf.dropup), g.conf.split[t].fade === q && (g.conf.split[t].fade = g.conf.fade)); else f(g.node).append(f('<span class="dt-down-arrow">' + this.c.dom.splitDropdown.text + "</span>")); this._expandButton(g.buttons, g.conf.buttons, g.conf.split, !b, b, e, g.conf)
                            } g.conf.parent = h; n.init && n.init.call(l.button(g.node), l, f(g.node), n); m++
                        }
                }
            }
        }, _buildButton: function (a, b, c, d) {
            var k = this.c.dom.button, e = this.c.dom.buttonLiner, h = this.c.dom.collection, l = this.c.dom.splitCollection, m = this.c.dom.splitDropdownButton,
            p = this.s.dt, r = function (w) { return "function" === typeof w ? w(p, g, a) : w }; if (a.spacer) { var n = f("<span></span>").addClass("dt-button-spacer " + a.style + " " + k.spacerClass).html(r(a.text)); return { conf: a, node: n, inserter: n, buttons: [], inCollection: b, isSplit: c, inSplit: d, collection: null } } !c && d && l ? k = m : !c && b && h.button && (k = h.button); !c && d && l.buttonLiner ? e = l.buttonLiner : !c && b && h.buttonLiner && (e = h.buttonLiner); if (a.available && !a.available(p, a) && !a.hasOwnProperty("html")) return !1; if (a.hasOwnProperty("html")) var g = f(a.html);
            else {
                var t = function (w, A, E, F) { F.action.call(A.button(E), w, A, E, F); f(A.table().node()).triggerHandler("buttons-action.dt", [A.button(E), A, E, F]) }; h = a.tag || k.tag; var z = a.clickBlurs === q ? !0 : a.clickBlurs; g = f("<" + h + "/>").addClass(k.className).addClass(d ? this.c.dom.splitDropdownButton.className : "").attr("tabindex", this.s.dt.settings()[0].iTabIndex).attr("aria-controls", this.s.dt.table().node().id).on("click.dtb", function (w) { w.preventDefault(); !g.hasClass(k.disabled) && a.action && t(w, p, g, a); z && g.trigger("blur") }).on("keypress.dtb",
                    function (w) { 13 === w.keyCode && (w.preventDefault(), !g.hasClass(k.disabled) && a.action && t(w, p, g, a)) }); "a" === h.toLowerCase() && g.attr("href", "#"); "button" === h.toLowerCase() && g.attr("type", "button"); e.tag ? (h = f("<" + e.tag + "/>").html(r(a.text)).addClass(e.className), "a" === e.tag.toLowerCase() && h.attr("href", "#"), g.append(h)) : g.html(r(a.text)); !1 === a.enabled && g.addClass(k.disabled); a.className && g.addClass(a.className); a.titleAttr && g.attr("title", r(a.titleAttr)); a.attr && g.attr(a.attr); a.namespace || (a.namespace =
                        ".dt-button-" + P++); a.config !== q && a.config.split && (a.split = a.config.split)
            } e = (e = this.c.dom.buttonContainer) && e.tag ? f("<" + e.tag + "/>").addClass(e.className).append(g) : g; this._addKey(a); this.c.buttonCreated && (e = this.c.buttonCreated(a, e)); if (c) {
                n = f("<div/>").addClass(this.c.dom.splitWrapper.className); n.append(g); var B = f.extend(a, { text: this.c.dom.splitDropdown.text, className: this.c.dom.splitDropdown.className, attr: { "aria-haspopup": !0, "aria-expanded": !1 }, align: this.c.dom.splitDropdown.align, splitAlignClass: this.c.dom.splitDropdown.splitAlignClass });
                this._addKey(B); var G = function (w, A, E, F) { y.split.action.call(A.button(f("div.dt-btn-split-wrapper")[0]), w, A, E, F); f(A.table().node()).triggerHandler("buttons-action.dt", [A.button(E), A, E, F]); E.attr("aria-expanded", !0) }, D = f('<button class="' + this.c.dom.splitDropdown.className + ' dt-button"><span class="dt-btn-split-drop-arrow">' + this.c.dom.splitDropdown.text + "</span></button>").on("click.dtb", function (w) { w.preventDefault(); w.stopPropagation(); D.hasClass(k.disabled) || G(w, p, D, B); z && D.trigger("blur") }).on("keypress.dtb",
                    function (w) { 13 === w.keyCode && (w.preventDefault(), D.hasClass(k.disabled) || G(w, p, D, B)) }); 0 === a.split.length && D.addClass("dtb-hide-drop"); n.append(D).attr(B.attr)
            } return { conf: a, node: c ? n.get(0) : g.get(0), inserter: c ? n : e, buttons: [], inCollection: b, isSplit: c, inSplit: d, collection: null }
        }, _nodeToButton: function (a, b) { b || (b = this.s.buttons); for (var c = 0, d = b.length; c < d; c++) { if (b[c].node === a) return b[c]; if (b[c].buttons.length) { var k = this._nodeToButton(a, b[c].buttons); if (k) return k } } }, _nodeToHost: function (a, b) {
            b || (b =
                this.s.buttons); for (var c = 0, d = b.length; c < d; c++) { if (b[c].node === a) return b; if (b[c].buttons.length) { var k = this._nodeToHost(a, b[c].buttons); if (k) return k } }
        }, _keypress: function (a, b) {
            if (!b._buttonsHandled) {
                var c = function (d) {
                    for (var k = 0, e = d.length; k < e; k++) {
                        var h = d[k].conf, l = d[k].node; h.key && (h.key === a ? (b._buttonsHandled = !0, f(l).click()) : !f.isPlainObject(h.key) || h.key.key !== a || h.key.shiftKey && !b.shiftKey || h.key.altKey && !b.altKey || h.key.ctrlKey && !b.ctrlKey || h.key.metaKey && !b.metaKey || (b._buttonsHandled = !0,
                            f(l).click())); d[k].buttons.length && c(d[k].buttons)
                    }
                }; c(this.s.buttons)
            }
        }, _removeKey: function (a) { if (a.key) { var b = f.isPlainObject(a.key) ? a.key.key : a.key; a = this.s.listenKeys.split(""); b = f.inArray(b, a); a.splice(b, 1); this.s.listenKeys = a.join("") } }, _resolveExtends: function (a) {
            var b = this, c = this.s.dt, d, k = function (m) {
                for (var p = 0; !f.isPlainObject(m) && !Array.isArray(m);) {
                    if (m === q) return; if ("function" === typeof m) { if (m = m.call(b, c, a), !m) return !1 } else if ("string" === typeof m) { if (!y[m]) return { html: m }; m = y[m] } p++;
                    if (30 < p) throw "Buttons: Too many iterations";
                } return Array.isArray(m) ? m : f.extend({}, m)
            }; for (a = k(a); a && a.extend;) {
                if (!y[a.extend]) throw "Cannot extend unknown button type: " + a.extend; var e = k(y[a.extend]); if (Array.isArray(e)) return e; if (!e) return !1; var h = e.className; a.config !== q && e.config !== q && (a.config = f.extend({}, e.config, a.config)); a = f.extend({}, e, a); h && a.className !== h && (a.className = h + " " + a.className); var l = a.postfixButtons; if (l) {
                    a.buttons || (a.buttons = []); h = 0; for (d = l.length; h < d; h++)a.buttons.push(l[h]);
                    a.postfixButtons = null
                } if (l = a.prefixButtons) { a.buttons || (a.buttons = []); h = 0; for (d = l.length; h < d; h++)a.buttons.splice(h, 0, l[h]); a.prefixButtons = null } a.extend = e.extend
            } return a
        }, _popover: function (a, b, c, d) {
            d = this.c; var k = !1, e = f.extend({
                align: "button-left", autoClose: !1, background: !0, backgroundClassName: "dt-button-background", contentClassName: d.dom.collection.className, collectionLayout: "", collectionTitle: "", dropup: !1, fade: 400, popoverTitle: "", rightAlignClassName: "dt-button-right", splitRightAlignClassName: "dt-button-split-right",
                splitLeftAlignClassName: "dt-button-split-left", tag: d.dom.collection.tag
            }, c), h = b.node(), l = function () { k = !0; J(f(".dt-button-collection"), e.fade, function () { f(this).detach() }); f(b.buttons('[aria-haspopup="true"][aria-expanded="true"]').nodes()).attr("aria-expanded", "false"); f("div.dt-button-background").off("click.dtb-collection"); v.background(!1, e.backgroundClassName, e.fade, h); f("body").off(".dtb-collection"); b.off("buttons-action.b-internal"); b.off("destroy") }; if (!1 === a) l(); else {
                c = f(b.buttons('[aria-haspopup="true"][aria-expanded="true"]').nodes());
                c.length && (h.closest("div.dt-button-collection").length && (h = c.eq(0)), l()); c = f("<div/>").addClass("dt-button-collection").addClass(e.collectionLayout).addClass(e.splitAlignClass).css("display", "none"); a = f(a).addClass(e.contentClassName).attr("role", "menu").appendTo(c); h.attr("aria-expanded", "true"); h.parents("body")[0] !== x.body && (h = x.body.lastChild); e.popoverTitle ? c.prepend('<div class="dt-button-collection-title">' + e.popoverTitle + "</div>") : e.collectionTitle && c.prepend('<div class="dt-button-collection-title">' +
                    e.collectionTitle + "</div>"); I(c.insertAfter(h), e.fade); var m = f(b.table().container()); d = c.css("position"); "dt-container" === e.align && (h = h.parent(), c.css("width", m.width())); if ("absolute" === d) {
                        var p = h.position(); d = f(b.node()).position(); c.css({ top: f(f(b[0].node).parent()[0]).hasClass("dt-buttons") ? d.top + h.outerHeight() : p.top + h.outerHeight(), left: p.left }); p = c.outerHeight(); var r = m.offset().top + m.height(); r = d.top + h.outerHeight() + p - r; var n = d.top - p, g = m.offset().top; d = d.top - p - 5; (r > g - n || e.dropup) && -d < g &&
                            c.css("top", d); d = m.offset().left; m = m.width(); m = d + m; p = c.offset().left; r = c.outerWidth(); 0 === r && 0 < c.children().length && (r = f(c.children()[0]).outerWidth()); r = p + r; var t = h.offset().left; g = h.outerWidth(); n = t + g; if (c.hasClass(e.rightAlignClassName) || c.hasClass(e.leftAlignClassName) || c.hasClass(e.splitAlignClass) || "dt-container" === e.align) {
                                var z = n; h.hasClass("dt-btn-split-wrapper") && 0 < h.children("button.dt-btn-split-drop").length && (t = h.children("button.dt-btn-split-drop").offset().left, g = h.children("button.dt-btn-split-drop").outerWidth(),
                                    z = t + g); g = 0; if (c.hasClass(e.rightAlignClassName)) g = n - r, d > p + g && (d -= p + g, m -= r + g, g = d > m ? g + m : g + d); else if (c.hasClass(e.splitRightAlignClassName)) g = z - r, d > p + g && (d -= p + g, m -= r + g, g = d > m ? g + m : g + d); else if (c.hasClass(e.splitLeftAlignClassName)) { if (g = t - p, m < r + g || d > p + g) d -= p + g, m -= r + g, g = d > m ? g + m : g + d } else g = d - p, m < r + g && (d -= p + g, m -= r + g, g = d > m ? g + m : g + d)
                            } else d = h.offset().top, g = 0, g = "button-right" === e.align ? n - r : t - p; c.css("left", c.position().left + g)
                    } else d = c.height() / 2, d > f(C).height() / 2 && (d = f(C).height() / 2), c.css("marginTop", -1 *
                        d); e.background && v.background(!0, e.backgroundClassName, e.fade, h); f("div.dt-button-background").on("click.dtb-collection", function () { }); e.autoClose && setTimeout(function () { b.on("buttons-action.b-internal", function (B, G, D, w) { w[0] !== h[0] && l() }) }, 0); f(c).trigger("buttons-popover.dt"); b.on("destroy", l); setTimeout(function () {
                            k = !1; f("body").on("click.dtb-collection", function (B) {
                                if (!k) {
                                    var G = f.fn.addBack ? "addBack" : "andSelf", D = f(B.target).parent()[0]; (!f(B.target).parents()[G]().filter(a).length && !f(D).hasClass("dt-buttons") ||
                                        f(B.target).hasClass("dt-button-background")) && l()
                                }
                            }).on("keyup.dtb-collection", function (B) { 27 === B.keyCode && l() })
                        }, 0)
            }
        }
    }); v.background = function (a, b, c, d) { c === q && (c = 400); d || (d = x.body); a ? I(f("<div/>").addClass(b).css("display", "none").insertAfter(d), c) : J(f("div." + b), c, function () { f(this).removeClass(b).remove() }) }; v.instanceSelector = function (a, b) {
        if (a === q || null === a) return f.map(b, function (e) { return e.inst }); var c = [], d = f.map(b, function (e) { return e.name }), k = function (e) {
            if (Array.isArray(e)) for (var h = 0, l =
                e.length; h < l; h++)k(e[h]); else "string" === typeof e ? -1 !== e.indexOf(",") ? k(e.split(",")) : (e = f.inArray(e.trim(), d), -1 !== e && c.push(b[e].inst)) : "number" === typeof e ? c.push(b[e].inst) : "object" === typeof e && c.push(e)
        }; k(a); return c
    }; v.buttonSelector = function (a, b) {
        for (var c = [], d = function (l, m, p) { for (var r, n, g = 0, t = m.length; g < t; g++)if (r = m[g]) n = p !== q ? p + g : g + "", l.push({ node: r.node, name: r.conf.name, idx: n }), r.buttons && d(l, r.buttons, n + "-") }, k = function (l, m) {
            var p, r = []; d(r, m.s.buttons); var n = f.map(r, function (g) { return g.node });
            if (Array.isArray(l) || l instanceof f) for (n = 0, p = l.length; n < p; n++)k(l[n], m); else if (null === l || l === q || "*" === l) for (n = 0, p = r.length; n < p; n++)c.push({ inst: m, node: r[n].node }); else if ("number" === typeof l) m.s.buttons[l] && c.push({ inst: m, node: m.s.buttons[l].node }); else if ("string" === typeof l) if (-1 !== l.indexOf(",")) for (r = l.split(","), n = 0, p = r.length; n < p; n++)k(r[n].trim(), m); else if (l.match(/^\d+(\-\d+)*$/)) n = f.map(r, function (g) { return g.idx }), c.push({ inst: m, node: r[f.inArray(l, n)].node }); else if (-1 !== l.indexOf(":name")) for (l =
                l.replace(":name", ""), n = 0, p = r.length; n < p; n++)r[n].name === l && c.push({ inst: m, node: r[n].node }); else f(n).filter(l).each(function () { c.push({ inst: m, node: this }) }); else "object" === typeof l && l.nodeName && (r = f.inArray(l, n), -1 !== r && c.push({ inst: m, node: n[r] }))
        }, e = 0, h = a.length; e < h; e++)k(b, a[e]); return c
    }; v.stripData = function (a, b) {
        if ("string" !== typeof a) return a; a = a.replace(/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi, ""); a = a.replace(/<!\-\-.*?\-\->/g, ""); if (!b || b.stripHtml) a = a.replace(/<[^>]*>/g, ""); if (!b ||
            b.trim) a = a.replace(/^\s+|\s+$/g, ""); if (!b || b.stripNewlines) a = a.replace(/\n/g, " "); if (!b || b.decodeEntities) M.innerHTML = a, a = M.value; return a
    }; v.defaults = {
        buttons: ["copy", "excel", "csv", "pdf", "print"], name: "main", tabIndex: 0, dom: {
            container: { tag: "div", className: "dt-buttons" }, collection: { tag: "div", className: "" }, button: { tag: "button", className: "dt-button", active: "active", disabled: "disabled", spacerClass: "" }, buttonLiner: { tag: "span", className: "" }, split: { tag: "div", className: "dt-button-split" }, splitWrapper: {
                tag: "div",
                className: "dt-btn-split-wrapper"
            }, splitDropdown: { tag: "button", text: "&#x25BC;", className: "dt-btn-split-drop", align: "split-right", splitAlignClass: "dt-button-split-left" }, splitDropdownButton: { tag: "button", className: "dt-btn-split-drop-button dt-button" }, splitCollection: { tag: "div", className: "dt-button-split-collection" }
        }
    }; v.version = "2.1.0"; f.extend(y, {
        collection: {
            text: function (a) { return a.i18n("buttons.collection", "Collection") }, className: "buttons-collection", init: function (a, b, c) {
                b.attr("aria-expanded",
                    !1)
            }, action: function (a, b, c, d) { d._collection.parents("body").length ? this.popover(!1, d) : this.popover(d._collection, d) }, attr: { "aria-haspopup": !0 }
        }, split: { text: function (a) { return a.i18n("buttons.split", "Split") }, className: "buttons-split", init: function (a, b, c) { return b.attr("aria-expanded", !1) }, action: function (a, b, c, d) { this.popover(d._collection, d) }, attr: { "aria-haspopup": !0 } }, copy: function (a, b) { if (y.copyHtml5) return "copyHtml5" }, csv: function (a, b) { if (y.csvHtml5 && y.csvHtml5.available(a, b)) return "csvHtml5" },
        excel: function (a, b) { if (y.excelHtml5 && y.excelHtml5.available(a, b)) return "excelHtml5" }, pdf: function (a, b) { if (y.pdfHtml5 && y.pdfHtml5.available(a, b)) return "pdfHtml5" }, pageLength: function (a) {
            a = a.settings()[0].aLengthMenu; var b = [], c = []; if (Array.isArray(a[0])) b = a[0], c = a[1]; else for (var d = 0; d < a.length; d++) { var k = a[d]; f.isPlainObject(k) ? (b.push(k.value), c.push(k.label)) : (b.push(k), c.push(k)) } return {
                extend: "collection", text: function (e) {
                    return e.i18n("buttons.pageLength", { "-1": "Show all rows", _: "Show %d rows" },
                        e.page.len())
                }, className: "buttons-page-length", autoClose: !0, buttons: f.map(b, function (e, h) { return { text: c[h], className: "button-page-length", action: function (l, m) { m.page.len(e).draw() }, init: function (l, m, p) { var r = this; m = function () { r.active(l.page.len() === e) }; l.on("length.dt" + p.namespace, m); m() }, destroy: function (l, m, p) { l.off("length.dt" + p.namespace) } } }), init: function (e, h, l) { var m = this; e.on("length.dt" + l.namespace, function () { m.text(l.text) }) }, destroy: function (e, h, l) { e.off("length.dt" + l.namespace) }
            }
        }, spacer: {
            style: "empty",
            spacer: !0, text: function (a) { return a.i18n("buttons.spacer", "") }
        }
    }); u.Api.register("buttons()", function (a, b) { b === q && (b = a, a = q); this.selector.buttonGroup = a; var c = this.iterator(!0, "table", function (d) { if (d._buttons) return v.buttonSelector(v.instanceSelector(a, d._buttons), b) }, !0); c._groupSelector = a; return c }); u.Api.register("button()", function (a, b) { a = this.buttons(a, b); 1 < a.length && a.splice(1, a.length); return a }); u.Api.registerPlural("buttons().active()", "button().active()", function (a) {
        return a === q ? this.map(function (b) { return b.inst.active(b.node) }) :
            this.each(function (b) { b.inst.active(b.node, a) })
    }); u.Api.registerPlural("buttons().action()", "button().action()", function (a) { return a === q ? this.map(function (b) { return b.inst.action(b.node) }) : this.each(function (b) { b.inst.action(b.node, a) }) }); u.Api.registerPlural("buttons().collectionRebuild()", "button().collectionRebuild()", function (a) { return this.each(function (b) { for (var c = 0; c < a.length; c++)"object" === typeof a[c] && (a[c].parentConf = b); b.inst.collectionRebuild(b.node, a) }) }); u.Api.register(["buttons().enable()",
        "button().enable()"], function (a) { return this.each(function (b) { b.inst.enable(b.node, a) }) }); u.Api.register(["buttons().disable()", "button().disable()"], function () { return this.each(function (a) { a.inst.disable(a.node) }) }); u.Api.register("button().index()", function () { var a = null; this.each(function (b) { b = b.inst.index(b.node); null !== b && (a = b) }); return a }); u.Api.registerPlural("buttons().nodes()", "button().node()", function () { var a = f(); f(this.each(function (b) { a = a.add(b.inst.node(b.node)) })); return a }); u.Api.registerPlural("buttons().processing()",
            "button().processing()", function (a) { return a === q ? this.map(function (b) { return b.inst.processing(b.node) }) : this.each(function (b) { b.inst.processing(b.node, a) }) }); u.Api.registerPlural("buttons().text()", "button().text()", function (a) { return a === q ? this.map(function (b) { return b.inst.text(b.node) }) : this.each(function (b) { b.inst.text(b.node, a) }) }); u.Api.registerPlural("buttons().trigger()", "button().trigger()", function () { return this.each(function (a) { a.inst.node(a.node).trigger("click") }) }); u.Api.register("button().popover()",
                function (a, b) { return this.map(function (c) { return c.inst._popover(a, this.button(this[0].node), b) }) }); u.Api.register("buttons().containers()", function () { var a = f(), b = this._groupSelector; this.iterator(!0, "table", function (c) { if (c._buttons) { c = v.instanceSelector(b, c._buttons); for (var d = 0, k = c.length; d < k; d++)a = a.add(c[d].container()) } }); return a }); u.Api.register("buttons().container()", function () { return this.containers().eq(0) }); u.Api.register("button().add()", function (a, b, c) {
                    var d = this.context; d.length &&
                        (d = v.instanceSelector(this._groupSelector, d[0]._buttons), d.length && d[0].add(b, a, c)); return this.button(this._groupSelector, a)
                }); u.Api.register("buttons().destroy()", function () { this.pluck("inst").unique().each(function (a) { a.destroy() }); return this }); u.Api.registerPlural("buttons().remove()", "buttons().remove()", function () { this.each(function (a) { a.inst.remove(a.node) }); return this }); var H; u.Api.register("buttons.info()", function (a, b, c) {
                    var d = this; if (!1 === a) return this.off("destroy.btn-info"), J(f("#datatables_buttons_info"),
                        400, function () { f(this).remove() }), clearTimeout(H), H = null, this; H && clearTimeout(H); f("#datatables_buttons_info").length && f("#datatables_buttons_info").remove(); a = a ? "<h2>" + a + "</h2>" : ""; I(f('<div id="datatables_buttons_info" class="dt-button-info"/>').html(a).append(f("<div/>")["string" === typeof b ? "html" : "append"](b)).css("display", "none").appendTo("body")); c !== q && 0 !== c && (H = setTimeout(function () { d.buttons.info(!1) }, c)); this.on("destroy.btn-info", function () { d.buttons.info(!1) }); return this
                }); u.Api.register("buttons.exportData()",
                    function (a) { if (this.context.length) return Q(new u.Api(this.context[0]), a) }); u.Api.register("buttons.exportInfo()", function (a) {
                        a || (a = {}); var b = a; var c = "*" === b.filename && "*" !== b.title && b.title !== q && null !== b.title && "" !== b.title ? b.title : b.filename; "function" === typeof c && (c = c()); c === q || null === c ? c = null : (-1 !== c.indexOf("*") && (c = c.replace("*", f("head > title").text()).trim()), c = c.replace(/[^a-zA-Z0-9_\u00A1-\uFFFF\.,\-_ !\(\)]/g, ""), (b = K(b.extension)) || (b = ""), c += b); b = K(a.title); b = null === b ? null : -1 !== b.indexOf("*") ?
                            b.replace("*", f("head > title").text() || "Exported data") : b; return { filename: c, title: b, messageTop: N(this, a.message || a.messageTop, "top"), messageBottom: N(this, a.messageBottom, "bottom") }
                    }); var K = function (a) { return null === a || a === q ? null : "function" === typeof a ? a() : a }, N = function (a, b, c) { b = K(b); if (null === b) return null; a = f("caption", a.table().container()).eq(0); return "*" === b ? a.css("caption-side") !== c ? null : a.length ? a.text() : "" : b }, M = f("<textarea/>")[0], Q = function (a, b) {
                        var c = f.extend(!0, {}, {
                            rows: null, columns: "",
                            modifier: { search: "applied", order: "applied" }, orthogonal: "display", stripHtml: !0, stripNewlines: !0, decodeEntities: !0, trim: !0, format: { header: function (t) { return v.stripData(t, c) }, footer: function (t) { return v.stripData(t, c) }, body: function (t) { return v.stripData(t, c) } }, customizeData: null
                        }, b); b = a.columns(c.columns).indexes().map(function (t) { var z = a.column(t).header(); return c.format.header(z.innerHTML, t, z) }).toArray(); var d = a.table().footer() ? a.columns(c.columns).indexes().map(function (t) {
                            var z = a.column(t).footer();
                            return c.format.footer(z ? z.innerHTML : "", t, z)
                        }).toArray() : null, k = f.extend({}, c.modifier); a.select && "function" === typeof a.select.info && k.selected === q && a.rows(c.rows, f.extend({ selected: !0 }, k)).any() && f.extend(k, { selected: !0 }); k = a.rows(c.rows, k).indexes().toArray(); var e = a.cells(k, c.columns); k = e.render(c.orthogonal).toArray(); e = e.nodes().toArray(); for (var h = b.length, l = [], m = 0, p = 0, r = 0 < h ? k.length / h : 0; p < r; p++) { for (var n = [h], g = 0; g < h; g++)n[g] = c.format.body(k[m], p, g, e[m]), m++; l[p] = n } b = { header: b, footer: d, body: l };
                        c.customizeData && c.customizeData(b); return b
                    }; f.fn.dataTable.Buttons = v; f.fn.DataTable.Buttons = v; f(x).on("init.dt plugin-init.dt", function (a, b) { "dt" === a.namespace && (a = b.oInit.buttons || u.defaults.buttons) && !b._buttons && (new v(b, a)).container() }); u.ext.feature.push({ fnInit: L, cFeature: "B" }); u.ext.features && u.ext.features.register("buttons", L); return v
});