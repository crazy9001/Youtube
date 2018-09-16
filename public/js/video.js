!function (t, e) {
    "object" == typeof exports && "undefined" != typeof module ? module.exports = e() : "function" == typeof define && define.amd ? define(e) : t.videojs = e()
}(this, function () {
    function t(t, e) {
        return e = {exports: {}}, t(e, e.exports), e.exports
    }

    function e(t, e) {
        Ve(t).forEach(function (n) {
            return e(t[n], n)
        })
    }

    function n(t, e) {
        var n = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : 0;
        return Ve(t).reduce(function (n, r) {
            return e(n, t[r], r)
        }, n)
    }

    function r(t) {
        for (var n = arguments.length, r = Array(n > 1 ? n - 1 : 0), i = 1; i < n; i++) r[i - 1] = arguments[i];
        return Object.assign ? Object.assign.apply(Object, [t].concat(r)) : (r.forEach(function (n) {
            n && e(n, function (e, n) {
                t[n] = e
            })
        }), t)
    }

    function i(t) {
        return !!t && "object" === (void 0 === t ? "undefined" : Ie(t))
    }

    function o(t) {
        return i(t) && "[object Object]" === Fe.call(t) && t.constructor === Object
    }

    function s(t) {
        return t.replace(/\n\r?\s*/g, "")
    }

    function a(t, e) {
        if (!t || !e) return "";
        if ("function" == typeof oe.getComputedStyle) {
            var n = oe.getComputedStyle(t);
            return n ? n[e] : ""
        }
        return t.currentStyle[e] || ""
    }

    function l(t) {
        return "string" == typeof t && /\S/.test(t)
    }

    function c(t) {
        if (/\s/.test(t)) throw new Error("class has illegal whitespace characters")
    }

    function u(t) {
        return new RegExp("(^|\\s)" + t + "($|\\s)")
    }

    function h() {
        return ue === oe.document && void 0 !== ue.createElement
    }

    function p(t) {
        return i(t) && 1 === t.nodeType
    }

    function d() {
        try {
            return oe.parent !== oe.self
        } catch (t) {
            return !0
        }
    }

    function f(t) {
        return function (e, n) {
            if (!l(e)) return ue[t](null);
            l(n) && (n = ue.querySelector(n));
            var r = p(n) ? n : ue;
            return r[t] && r[t](e)
        }
    }

    function v() {
        var t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : "div",
            e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {},
            n = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : {}, r = arguments[3],
            i = ue.createElement(t);
        return Object.getOwnPropertyNames(e).forEach(function (t) {
            var n = e[t];
            -1 !== t.indexOf("aria-") || "role" === t || "type" === t ? (Xe.warn(qe(Ke, t, n)), i.setAttribute(t, n)) : "textContent" === t ? y(i, n) : i[t] = n
        }), Object.getOwnPropertyNames(n).forEach(function (t) {
            i.setAttribute(t, n[t])
        }), r && D(i, r), i
    }

    function y(t, e) {
        return void 0 === t.textContent ? t.innerText = e : t.textContent = e, t
    }

    function g(t, e) {
        e.firstChild ? e.insertBefore(t, e.firstChild) : e.appendChild(t)
    }

    function m(t, e) {
        return c(e), t.classList ? t.classList.contains(e) : u(e).test(t.className)
    }

    function _(t, e) {
        return t.classList ? t.classList.add(e) : m(t, e) || (t.className = (t.className + " " + e).trim()), t
    }

    function b(t, e) {
        return t.classList ? t.classList.remove(e) : (c(e), t.className = t.className.split(/\s+/).filter(function (t) {
            return t !== e
        }).join(" ")), t
    }

    function T(t, e, n) {
        var r = m(t, e);
        if ("function" == typeof n && (n = n(t, e)), "boolean" != typeof n && (n = !r), n !== r) return n ? _(t, e) : b(t, e), t
    }

    function C(t, e) {
        Object.getOwnPropertyNames(e).forEach(function (n) {
            var r = e[n];
            null === r || void 0 === r || !1 === r ? t.removeAttribute(n) : t.setAttribute(n, !0 === r ? "" : r)
        })
    }

    function k(t) {
        var e = {};
        if (t && t.attributes && t.attributes.length > 0) for (var n = t.attributes, r = n.length - 1; r >= 0; r--) {
            var i = n[r].name, o = n[r].value;
            "boolean" != typeof t[i] && -1 === ",autoplay,controls,playsinline,loop,muted,default,defaultMuted,".indexOf("," + i + ",") || (o = null !== o), e[i] = o
        }
        return e
    }

    function w(t, e) {
        return t.getAttribute(e)
    }

    function E(t, e, n) {
        t.setAttribute(e, n)
    }

    function S(t, e) {
        t.removeAttribute(e)
    }

    function x() {
        ue.body.focus(), ue.onselectstart = function () {
            return !1
        }
    }

    function j() {
        ue.onselectstart = function () {
            return !0
        }
    }

    function A(t) {
        if (t && t.getBoundingClientRect && t.parentNode) {
            var e = t.getBoundingClientRect(), n = {};
            return ["bottom", "height", "left", "right", "top", "width"].forEach(function (t) {
                void 0 !== e[t] && (n[t] = e[t])
            }), n.height || (n.height = parseFloat(a(t, "height"))), n.width || (n.width = parseFloat(a(t, "width"))), n
        }
    }

    function P(t) {
        var e = void 0;
        if (t.getBoundingClientRect && t.parentNode && (e = t.getBoundingClientRect()), !e) return {left: 0, top: 0};
        var n = ue.documentElement, r = ue.body, i = n.clientLeft || r.clientLeft || 0,
            o = oe.pageXOffset || r.scrollLeft, s = e.left + o - i, a = n.clientTop || r.clientTop || 0,
            l = oe.pageYOffset || r.scrollTop, c = e.top + l - a;
        return {left: Math.round(s), top: Math.round(c)}
    }

    function N(t, e) {
        var n = {}, r = P(t), i = t.offsetWidth, o = t.offsetHeight, s = r.top, a = r.left, l = e.pageY, c = e.pageX;
        return e.changedTouches && (c = e.changedTouches[0].pageX, l = e.changedTouches[0].pageY), n.y = Math.max(0, Math.min(1, (s - l + o) / o)), n.x = Math.max(0, Math.min(1, (c - a) / i)), n
    }

    function O(t) {
        return i(t) && 3 === t.nodeType
    }

    function M(t) {
        for (; t.firstChild;) t.removeChild(t.firstChild);
        return t
    }

    function I(t) {
        return "function" == typeof t && (t = t()), (Array.isArray(t) ? t : [t]).map(function (t) {
            return "function" == typeof t && (t = t()), p(t) || O(t) ? t : "string" == typeof t && /\S/.test(t) ? ue.createTextNode(t) : void 0
        }).filter(function (t) {
            return t
        })
    }

    function D(t, e) {
        return I(e).forEach(function (e) {
            return t.appendChild(e)
        }), t
    }

    function L(t, e) {
        return D(M(t), e)
    }

    function R() {
        return Je++
    }

    function B(t) {
        var e = t[Ze];
        return e || (e = t[Ze] = R()), Qe[e] || (Qe[e] = {}), Qe[e]
    }

    function F(t) {
        var e = t[Ze];
        return !!e && !!Object.getOwnPropertyNames(Qe[e]).length
    }

    function V(t) {
        var e = t[Ze];
        if (e) {
            delete Qe[e];
            try {
                delete t[Ze]
            } catch (e) {
                t.removeAttribute ? t.removeAttribute(Ze) : t[Ze] = null
            }
        }
    }

    function H(t, e) {
        var n = B(t);
        0 === n.handlers[e].length && (delete n.handlers[e], t.removeEventListener ? t.removeEventListener(e, n.dispatcher, !1) : t.detachEvent && t.detachEvent("on" + e, n.dispatcher)), Object.getOwnPropertyNames(n.handlers).length <= 0 && (delete n.handlers, delete n.dispatcher, delete n.disabled), 0 === Object.getOwnPropertyNames(n).length && V(t)
    }

    function W(t, e, n, r) {
        n.forEach(function (n) {
            t(e, n, r)
        })
    }

    function U(t) {
        function e() {
            return !0
        }

        function n() {
            return !1
        }

        if (!t || !t.isPropagationStopped) {
            var r = t || oe.event;
            t = {};
            for (var i in r) "layerX" !== i && "layerY" !== i && "keyLocation" !== i && "webkitMovementX" !== i && "webkitMovementY" !== i && ("returnValue" === i && r.preventDefault || (t[i] = r[i]));
            if (t.target || (t.target = t.srcElement || ue), t.relatedTarget || (t.relatedTarget = t.fromElement === t.target ? t.toElement : t.fromElement), t.preventDefault = function () {
                r.preventDefault && r.preventDefault(), t.returnValue = !1, r.returnValue = !1, t.defaultPrevented = !0
            }, t.defaultPrevented = !1, t.stopPropagation = function () {
                r.stopPropagation && r.stopPropagation(), t.cancelBubble = !0, r.cancelBubble = !0, t.isPropagationStopped = e
            }, t.isPropagationStopped = n, t.stopImmediatePropagation = function () {
                r.stopImmediatePropagation && r.stopImmediatePropagation(), t.isImmediatePropagationStopped = e, t.stopPropagation()
            }, t.isImmediatePropagationStopped = n, null !== t.clientX && void 0 !== t.clientX) {
                var o = ue.documentElement, s = ue.body;
                t.pageX = t.clientX + (o && o.scrollLeft || s && s.scrollLeft || 0) - (o && o.clientLeft || s && s.clientLeft || 0), t.pageY = t.clientY + (o && o.scrollTop || s && s.scrollTop || 0) - (o && o.clientTop || s && s.clientTop || 0)
            }
            t.which = t.charCode || t.keyCode, null !== t.button && void 0 !== t.button && (t.button = 1 & t.button ? 0 : 4 & t.button ? 1 : 2 & t.button ? 2 : 0)
        }
        return t
    }

    function z(t, e, n) {
        if (Array.isArray(e)) return W(z, t, e, n);
        var r = B(t);
        if (r.handlers || (r.handlers = {}), r.handlers[e] || (r.handlers[e] = []), n.guid || (n.guid = R()), r.handlers[e].push(n), r.dispatcher || (r.disabled = !1, r.dispatcher = function (e, n) {
            if (!r.disabled) {
                e = U(e);
                var i = r.handlers[e.type];
                if (i) for (var o = i.slice(0), s = 0, a = o.length; s < a && !e.isImmediatePropagationStopped(); s++) try {
                    o[s].call(t, e, n)
                } catch (t) {
                    Xe.error(t)
                }
            }
        }), 1 === r.handlers[e].length) if (t.addEventListener) {
            var i = !1;
            tn && en.indexOf(e) > -1 && (i = {passive: !0}), t.addEventListener(e, r.dispatcher, i)
        } else t.attachEvent && t.attachEvent("on" + e, r.dispatcher)
    }

    function X(t, e, n) {
        if (F(t)) {
            var r = B(t);
            if (r.handlers) {
                if (Array.isArray(e)) return W(X, t, e, n);
                var i = function (e) {
                    r.handlers[e] = [], H(t, e)
                };
                if (e) {
                    var o = r.handlers[e];
                    if (o) {
                        if (!n) return void i(e);
                        if (n.guid) for (var s = 0; s < o.length; s++) o[s].guid === n.guid && o.splice(s--, 1);
                        H(t, e)
                    }
                } else for (var a in r.handlers) i(a)
            }
        }
    }

    function q(t, e, n) {
        var r = F(t) ? B(t) : {}, i = t.parentNode || t.ownerDocument;
        if ("string" == typeof e && (e = {
            type: e,
            target: t
        }), e = U(e), r.dispatcher && r.dispatcher.call(t, e, n), i && !e.isPropagationStopped() && !0 === e.bubbles) q.call(null, i, e, n); else if (!i && !e.defaultPrevented) {
            var o = B(e.target);
            e.target[e.type] && (o.disabled = !0, "function" == typeof e.target[e.type] && e.target[e.type](), o.disabled = !1)
        }
        return !e.defaultPrevented
    }

    function K(t, e, n) {
        if (Array.isArray(e)) return W(K, t, e, n);
        var r = function r() {
            X(t, e, r), n.apply(this, arguments)
        };
        r.guid = n.guid = n.guid || R(), z(t, e, r)
    }

    function Y(t, e) {
        e && (on = e), oe.setTimeout(sn, t)
    }

    function G(t) {
        var e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {}, n = e.eventBusKey;
        if (n) {
            if (!t[n].nodeName) throw new Error('The eventBusKey "' + n + '" does not refer to an element.');
            t.eventBusEl_ = t[n]
        } else t.eventBusEl_ = v("span", {className: "vjs-event-bus"});
        return r(t, _n), t.on("dispose", function () {
            return t.off()
        }), t
    }

    function $(t, e) {
        return r(t, bn), t.state = r({}, t.state, e), "function" == typeof t.handleStateChanged && pn(t) && t.on("statechanged", t.handleStateChanged), t
    }

    function J(t) {
        return "string" != typeof t ? t : t.charAt(0).toUpperCase() + t.slice(1)
    }

    function Q(t, e) {
        return J(t) === J(e)
    }

    function Z() {
        for (var t = {}, n = arguments.length, r = Array(n), i = 0; i < n; i++) r[i] = arguments[i];
        return r.forEach(function (n) {
            n && e(n, function (e, n) {
                if (!o(e)) return void(t[n] = e);
                o(t[n]) || (t[n] = {}), t[n] = Z(t[n], e)
            })
        }), t
    }

    function tt(t, e, n) {
        if ("number" != typeof e || e < 0 || e > n) throw new Error("Failed to execute '" + t + "' on 'TimeRanges': The index provided (" + e + ") is non-numeric or out of bounds (0-" + n + ").")
    }

    function et(t, e, n, r) {
        return tt(t, r, n.length - 1), n[r][e]
    }

    function nt(t) {
        return void 0 === t || 0 === t.length ? {
            length: 0, start: function () {
                throw new Error("This TimeRanges object is empty")
            }, end: function () {
                throw new Error("This TimeRanges object is empty")
            }
        } : {length: t.length, start: et.bind(null, "start", 0, t), end: et.bind(null, "end", 1, t)}
    }

    function rt(t, e) {
        return Array.isArray(t) ? nt(t) : void 0 === t || void 0 === e ? nt() : nt([[t, e]])
    }

    function it(t, e) {
        var n = 0, r = void 0, i = void 0;
        if (!e) return 0;
        t && t.length || (t = rt(0, 0));
        for (var o = 0; o < t.length; o++) r = t.start(o), i = t.end(o), i > e && (i = e), n += i - r;
        return n / e
    }

    function ot(t) {
        if (t instanceof ot) return t;
        "number" == typeof t ? this.code = t : "string" == typeof t ? this.message = t : i(t) && ("number" == typeof t.code && (this.code = t.code), r(this, t)), this.message || (this.message = ot.defaultMessages[this.code] || "")
    }

    function st(t, e) {
        var n, r = null;
        try {
            n = JSON.parse(t, e)
        } catch (t) {
            r = t
        }
        return [r, n]
    }

    function at(t) {
        var e = nr.call(t);
        return "[object Function]" === e || "function" == typeof t && "[object RegExp]" !== e || "undefined" != typeof window && (t === window.setTimeout || t === window.alert || t === window.confirm || t === window.prompt)
    }

    function lt(t, e, n) {
        if (!er(e)) throw new TypeError("iterator must be a function");
        arguments.length < 3 && (n = this), "[object Array]" === or.call(t) ? ct(t, e, n) : "string" == typeof t ? ut(t, e, n) : ht(t, e, n)
    }

    function ct(t, e, n) {
        for (var r = 0, i = t.length; r < i; r++) sr.call(t, r) && e.call(n, t[r], r, t)
    }

    function ut(t, e, n) {
        for (var r = 0, i = t.length; r < i; r++) e.call(n, t.charAt(r), r, t)
    }

    function ht(t, e, n) {
        for (var r in t) sr.call(t, r) && e.call(n, t[r], r, t)
    }

    function pt() {
        for (var t = {}, e = 0; e < arguments.length; e++) {
            var n = arguments[e];
            for (var r in n) ur.call(n, r) && (t[r] = n[r])
        }
        return t
    }

    function dt(t) {
        for (var e in t) if (t.hasOwnProperty(e)) return !1;
        return !0
    }

    function ft(t, e, n) {
        var r = t;
        return er(e) ? (n = e, "string" == typeof t && (r = {uri: t})) : r = cr(e, {uri: t}), r.callback = n, r
    }

    function vt(t, e, n) {
        return e = ft(t, e, n), yt(e)
    }

    function yt(t) {
        function e() {
            4 === a.readyState && setTimeout(i, 0)
        }

        function n() {
            var t = void 0;
            if (t = a.response ? a.response : a.responseText || gt(a), y) try {
                t = JSON.parse(t)
            } catch (t) {
            }
            return t
        }

        function r(t) {
            return clearTimeout(u), t instanceof Error || (t = new Error("" + (t || "Unknown XMLHttpRequest Error"))), t.statusCode = 0, s(t, g)
        }

        function i() {
            if (!c) {
                var e;
                clearTimeout(u), e = t.useXDR && void 0 === a.status ? 200 : 1223 === a.status ? 204 : a.status;
                var r = g, i = null;
                return 0 !== e ? (r = {
                    body: n(),
                    statusCode: e,
                    method: p,
                    headers: {},
                    url: h,
                    rawRequest: a
                }, a.getAllResponseHeaders && (r.headers = lr(a.getAllResponseHeaders()))) : i = new Error("Internal XMLHttpRequest Error"), s(i, r, r.body)
            }
        }

        if (void 0 === t.callback) throw new Error("callback argument missing");
        var o = !1, s = function (e, n, r) {
            o || (o = !0, t.callback(e, n, r))
        }, a = t.xhr || null;
        a || (a = t.cors || t.useXDR ? new vt.XDomainRequest : new vt.XMLHttpRequest);
        var l, c, u, h = a.url = t.uri || t.url, p = a.method = t.method || "GET", d = t.body || t.data,
            f = a.headers = t.headers || {}, v = !!t.sync, y = !1,
            g = {body: void 0, headers: {}, statusCode: 0, method: p, url: h, rawRequest: a};
        if ("json" in t && !1 !== t.json && (y = !0, f.accept || f.Accept || (f.Accept = "application/json"), "GET" !== p && "HEAD" !== p && (f["content-type"] || f["Content-Type"] || (f["Content-Type"] = "application/json"), d = JSON.stringify(!0 === t.json ? d : t.json))), a.onreadystatechange = e, a.onload = i, a.onerror = r, a.onprogress = function () {
        }, a.onabort = function () {
            c = !0
        }, a.ontimeout = r, a.open(p, h, !v, t.username, t.password), v || (a.withCredentials = !!t.withCredentials), !v && t.timeout > 0 && (u = setTimeout(function () {
            if (!c) {
                c = !0, a.abort("timeout");
                var t = new Error("XMLHttpRequest timeout");
                t.code = "ETIMEDOUT", r(t)
            }
        }, t.timeout)), a.setRequestHeader) for (l in f) f.hasOwnProperty(l) && a.setRequestHeader(l, f[l]); else if (t.headers && !dt(t.headers)) throw new Error("Headers cannot be set on an XDomainRequest object");
        return "responseType" in t && (a.responseType = t.responseType), "beforeSend" in t && "function" == typeof t.beforeSend && t.beforeSend(a), a.send(d || null), a
    }

    function gt(t) {
        if ("document" === t.responseType) return t.responseXML;
        var e = t.responseXML && "parsererror" === t.responseXML.documentElement.nodeName;
        return "" !== t.responseType || e ? null : t.responseXML
    }

    function mt() {
    }

    function _t(t, e) {
        this.name = "ParsingError", this.code = t.code, this.message = e || t.message
    }

    function bt(t) {
        function e(t, e, n, r) {
            return 3600 * (0 | t) + 60 * (0 | e) + (0 | n) + (0 | r) / 1e3
        }

        var n = t.match(/^(\d+):(\d{2})(:\d{2})?\.(\d{3})/);
        return n ? n[3] ? e(n[1], n[2], n[3].replace(":", ""), n[4]) : n[1] > 59 ? e(n[1], n[2], 0, n[4]) : e(0, n[1], n[2], n[4]) : null
    }

    function Tt() {
        this.values = kr(null)
    }

    function Ct(t, e, n, r) {
        var i = r ? t.split(r) : [t];
        for (var o in i) if ("string" == typeof i[o]) {
            var s = i[o].split(n);
            if (2 === s.length) {
                var a = s[0], l = s[1];
                e(a, l)
            }
        }
    }

    function kt(t, e, n) {
        function r() {
            var e = bt(t);
            if (null === e) throw new _t(_t.Errors.BadTimeStamp, "Malformed timestamp: " + o);
            return t = t.replace(/^[^\sa-zA-Z-]+/, ""), e
        }

        function i() {
            t = t.replace(/^\s+/, "")
        }

        var o = t;
        if (i(), e.startTime = r(), i(), "--\x3e" !== t.substr(0, 3)) throw new _t(_t.Errors.BadTimeStamp, "Malformed time stamp (time stamps must be separated by '--\x3e'): " + o);
        t = t.substr(3), i(), e.endTime = r(), i(), function (t, e) {
            var r = new Tt;
            Ct(t, function (t, e) {
                switch (t) {
                    case"region":
                        for (var i = n.length - 1; i >= 0; i--) if (n[i].id === e) {
                            r.set(t, n[i].region);
                            break
                        }
                        break;
                    case"vertical":
                        r.alt(t, e, ["rl", "lr"]);
                        break;
                    case"line":
                        var o = e.split(","), s = o[0];
                        r.integer(t, s), r.percent(t, s) && r.set("snapToLines", !1), r.alt(t, s, ["auto"]), 2 === o.length && r.alt("lineAlign", o[1], ["start", "middle", "end"]);
                        break;
                    case"position":
                        o = e.split(","), r.percent(t, o[0]), 2 === o.length && r.alt("positionAlign", o[1], ["start", "middle", "end"]);
                        break;
                    case"size":
                        r.percent(t, e);
                        break;
                    case"align":
                        r.alt(t, e, ["start", "middle", "end", "left", "right"])
                }
            }, /:/, /\s/), e.region = r.get("region", null), e.vertical = r.get("vertical", ""), e.line = r.get("line", "auto"), e.lineAlign = r.get("lineAlign", "start"), e.snapToLines = r.get("snapToLines", !0), e.size = r.get("size", 100), e.align = r.get("align", "middle"), e.position = r.get("position", {
                start: 0,
                left: 0,
                middle: 50,
                end: 100,
                right: 100
            }, e.align), e.positionAlign = r.get("positionAlign", {
                start: "start",
                left: "start",
                middle: "middle",
                end: "end",
                right: "end"
            }, e.align)
        }(t, e)
    }

    function wt(t, e) {
        function n(t) {
            return wr[t]
        }

        for (var r, i = t.document.createElement("div"), o = i, s = []; null !== (r = function () {
            if (!e) return null;
            var t = e.match(/^([^<]*)(<[^>]+>?)?/);
            return function (t) {
                return e = e.substr(t.length), t
            }(t[1] ? t[1] : t[2])
        }());) if ("<" !== r[0]) o.appendChild(t.document.createTextNode(function (t) {
            for (; c = t.match(/&(amp|lt|gt|lrm|rlm|nbsp);/);) t = t.replace(c[0], n);
            return t
        }(r))); else {
            if ("/" === r[1]) {
                s.length && s[s.length - 1] === r.substr(2).replace(">", "") && (s.pop(), o = o.parentNode);
                continue
            }
            var a, l = bt(r.substr(1, r.length - 2));
            if (l) {
                a = t.document.createProcessingInstruction("timestamp", l), o.appendChild(a);
                continue
            }
            var c = r.match(/^<([^.\s\/0-9>]+)(\.[^\s\\>]+)?([^>\\]+)?(\\?)>?$/);
            if (!c) continue;
            if (!(a = function (e, n) {
                var r = Er[e];
                if (!r) return null;
                var i = t.document.createElement(r);
                i.localName = r;
                var o = Sr[e];
                return o && n && (i[o] = n.trim()), i
            }(c[1], c[3]))) continue;
            if (!function (t, e) {
                return !xr[e.localName] || xr[e.localName] === t.localName
            }(o, a)) continue;
            c[2] && (a.className = c[2].substr(1).replace(".", " ")), s.push(c[1]), o.appendChild(a), o = a
        }
        return i
    }

    function Et(t) {
        for (var e = 0; e < jr.length; e++) {
            var n = jr[e];
            if (t >= n[0] && t <= n[1]) return !0
        }
        return !1
    }

    function St(t) {
        function e(t, e) {
            for (var n = e.childNodes.length - 1; n >= 0; n--) t.push(e.childNodes[n])
        }

        function n(t) {
            if (!t || !t.length) return null;
            var r = t.pop(), i = r.textContent || r.innerText;
            if (i) {
                var o = i.match(/^.*(\n|\r)/);
                return o ? (t.length = 0, o[0]) : i
            }
            return "ruby" === r.tagName ? n(t) : r.childNodes ? (e(t, r), n(t)) : void 0
        }

        var r, i = [], o = "";
        if (!t || !t.childNodes) return "ltr";
        for (e(i, t); o = n(i);) for (var s = 0; s < o.length; s++) if (r = o.charCodeAt(s), Et(r)) return "rtl";
        return "ltr"
    }

    function xt(t) {
        if ("number" == typeof t.line && (t.snapToLines || t.line >= 0 && t.line <= 100)) return t.line;
        if (!t.track || !t.track.textTrackList || !t.track.textTrackList.mediaElement) return -1;
        for (var e = t.track, n = e.textTrackList, r = 0, i = 0; i < n.length && n[i] !== e; i++) "showing" === n[i].mode && r++;
        return -1 * ++r
    }

    function jt() {
    }

    function At(t, e, n) {
        var r = /MSIE\s8\.0/.test(navigator.userAgent), i = "rgba(255, 255, 255, 1)", o = "rgba(0, 0, 0, 0.8)";
        r && (i = "rgb(255, 255, 255)", o = "rgb(0, 0, 0)"), jt.call(this), this.cue = e, this.cueDiv = wt(t, e.text);
        var s = {
            color: i,
            backgroundColor: o,
            position: "relative",
            left: 0,
            right: 0,
            top: 0,
            bottom: 0,
            display: "inline"
        };
        r || (s.writingMode = "" === e.vertical ? "horizontal-tb" : "lr" === e.vertical ? "vertical-lr" : "vertical-rl", s.unicodeBidi = "plaintext"), this.applyStyles(s, this.cueDiv), this.div = t.document.createElement("div"), s = {
            textAlign: "middle" === e.align ? "center" : e.align,
            font: n.font,
            whiteSpace: "pre-line",
            position: "absolute"
        }, r || (s.direction = St(this.cueDiv), s.writingMode = "" === e.vertical ? "horizontal-tb" : "lr" === e.vertical ? "vertical-lr" : "vertical-rl".stylesunicodeBidi = "plaintext"), this.applyStyles(s), this.div.appendChild(this.cueDiv);
        var a = 0;
        switch (e.positionAlign) {
            case"start":
                a = e.position;
                break;
            case"middle":
                a = e.position - e.size / 2;
                break;
            case"end":
                a = e.position - e.size
        }
        "" === e.vertical ? this.applyStyles({
            left: this.formatStyle(a, "%"),
            width: this.formatStyle(e.size, "%")
        }) : this.applyStyles({
            top: this.formatStyle(a, "%"),
            height: this.formatStyle(e.size, "%")
        }), this.move = function (t) {
            this.applyStyles({
                top: this.formatStyle(t.top, "px"),
                bottom: this.formatStyle(t.bottom, "px"),
                left: this.formatStyle(t.left, "px"),
                right: this.formatStyle(t.right, "px"),
                height: this.formatStyle(t.height, "px"),
                width: this.formatStyle(t.width, "px")
            })
        }
    }

    function Pt(t) {
        var e, n, r, i, o = /MSIE\s8\.0/.test(navigator.userAgent);
        if (t.div) {
            n = t.div.offsetHeight, r = t.div.offsetWidth, i = t.div.offsetTop;
            var s = (s = t.div.childNodes) && (s = s[0]) && s.getClientRects && s.getClientRects();
            t = t.div.getBoundingClientRect(), e = s ? Math.max(s[0] && s[0].height || 0, t.height / s.length) : 0
        }
        this.left = t.left, this.right = t.right, this.top = t.top || i, this.height = t.height || n, this.bottom = t.bottom || i + (t.height || n), this.width = t.width || r, this.lineHeight = void 0 !== e ? e : t.lineHeight, o && !this.lineHeight && (this.lineHeight = 13)
    }

    function Nt(t, e, n, r) {
        var i = new Pt(e), o = e.cue, s = xt(o), a = [];
        if (o.snapToLines) {
            var l;
            switch (o.vertical) {
                case"":
                    a = ["+y", "-y"], l = "height";
                    break;
                case"rl":
                    a = ["+x", "-x"], l = "width";
                    break;
                case"lr":
                    a = ["-x", "+x"], l = "width"
            }
            var c = i.lineHeight, u = c * Math.round(s), h = n[l] + c, p = a[0];
            Math.abs(u) > h && (u = u < 0 ? -1 : 1, u *= Math.ceil(h / c) * c), s < 0 && (u += "" === o.vertical ? n.height : n.width, a = a.reverse()), i.move(p, u)
        } else {
            var d = i.lineHeight / n.height * 100;
            switch (o.lineAlign) {
                case"middle":
                    s -= d / 2;
                    break;
                case"end":
                    s -= d
            }
            switch (o.vertical) {
                case"":
                    e.applyStyles({top: e.formatStyle(s, "%")});
                    break;
                case"rl":
                    e.applyStyles({left: e.formatStyle(s, "%")});
                    break;
                case"lr":
                    e.applyStyles({right: e.formatStyle(s, "%")})
            }
            a = ["+y", "-x", "+x", "-y"], i = new Pt(e)
        }
        var f = function (t, e) {
            for (var i, o = new Pt(t), s = 1, a = 0; a < e.length; a++) {
                for (; t.overlapsOppositeAxis(n, e[a]) || t.within(n) && t.overlapsAny(r);) t.move(e[a]);
                if (t.within(n)) return t;
                var l = t.intersectPercentage(n);
                s > l && (i = new Pt(t), s = l), t = new Pt(o)
            }
            return i || o
        }(i, a);
        e.move(f.toCSSCompatValues(n))
    }

    function Ot() {
    }

    function Mt(t) {
        return "string" == typeof t && (!!Nr[t.toLowerCase()] && t.toLowerCase())
    }

    function It(t) {
        return "string" == typeof t && (!!Or[t.toLowerCase()] && t.toLowerCase())
    }

    function Dt(t) {
        for (var e = 1; e < arguments.length; e++) {
            var n = arguments[e];
            for (var r in n) t[r] = n[r]
        }
        return t
    }

    function Lt(t, e, n) {
        var r = this, i = /MSIE\s8\.0/.test(navigator.userAgent), o = {};
        i ? r = document.createElement("custom") : o.enumerable = !0, r.hasBeenReset = !1;
        var s = "", a = !1, l = t, c = e, u = n, h = null, p = "", d = !0, f = "auto", v = "start", y = 50,
            g = "middle", m = 50, _ = "middle";
        if (Object.defineProperty(r, "id", Dt({}, o, {
            get: function () {
                return s
            }, set: function (t) {
                s = "" + t
            }
        })), Object.defineProperty(r, "pauseOnExit", Dt({}, o, {
            get: function () {
                return a
            }, set: function (t) {
                a = !!t
            }
        })), Object.defineProperty(r, "startTime", Dt({}, o, {
            get: function () {
                return l
            }, set: function (t) {
                if ("number" != typeof t) throw new TypeError("Start time must be set to a number.");
                l = t, this.hasBeenReset = !0
            }
        })), Object.defineProperty(r, "endTime", Dt({}, o, {
            get: function () {
                return c
            }, set: function (t) {
                if ("number" != typeof t) throw new TypeError("End time must be set to a number.");
                c = t, this.hasBeenReset = !0
            }
        })), Object.defineProperty(r, "text", Dt({}, o, {
            get: function () {
                return u
            }, set: function (t) {
                u = "" + t, this.hasBeenReset = !0
            }
        })), Object.defineProperty(r, "region", Dt({}, o, {
            get: function () {
                return h
            }, set: function (t) {
                h = t, this.hasBeenReset = !0
            }
        })), Object.defineProperty(r, "vertical", Dt({}, o, {
            get: function () {
                return p
            }, set: function (t) {
                var e = Mt(t);
                if (!1 === e) throw new SyntaxError("An invalid or illegal string was specified.");
                p = e, this.hasBeenReset = !0
            }
        })), Object.defineProperty(r, "snapToLines", Dt({}, o, {
            get: function () {
                return d
            }, set: function (t) {
                d = !!t, this.hasBeenReset = !0
            }
        })), Object.defineProperty(r, "line", Dt({}, o, {
            get: function () {
                return f
            }, set: function (t) {
                if ("number" != typeof t && t !== Pr) throw new SyntaxError("An invalid number or illegal string was specified.");
                f = t, this.hasBeenReset = !0
            }
        })), Object.defineProperty(r, "lineAlign", Dt({}, o, {
            get: function () {
                return v
            }, set: function (t) {
                var e = It(t);
                if (!e) throw new SyntaxError("An invalid or illegal string was specified.");
                v = e, this.hasBeenReset = !0
            }
        })), Object.defineProperty(r, "position", Dt({}, o, {
            get: function () {
                return y
            }, set: function (t) {
                if (t < 0 || t > 100) throw new Error("Position must be between 0 and 100.");
                y = t, this.hasBeenReset = !0
            }
        })), Object.defineProperty(r, "positionAlign", Dt({}, o, {
            get: function () {
                return g
            }, set: function (t) {
                var e = It(t);
                if (!e) throw new SyntaxError("An invalid or illegal string was specified.");
                g = e, this.hasBeenReset = !0
            }
        })), Object.defineProperty(r, "size", Dt({}, o, {
            get: function () {
                return m
            }, set: function (t) {
                if (t < 0 || t > 100) throw new Error("Size must be between 0 and 100.");
                m = t, this.hasBeenReset = !0
            }
        })), Object.defineProperty(r, "align", Dt({}, o, {
            get: function () {
                return _
            }, set: function (t) {
                var e = It(t);
                if (!e) throw new SyntaxError("An invalid or illegal string was specified.");
                _ = e, this.hasBeenReset = !0
            }
        })), r.displayState = void 0, i) return r
    }

    function Rt(t) {
        return "string" == typeof t && (!!Ir[t.toLowerCase()] && t.toLowerCase())
    }

    function Bt(t) {
        return "number" == typeof t && t >= 0 && t <= 100
    }

    function Ft() {
        var t = 100, e = 3, n = 0, r = 100, i = 0, o = 100, s = "";
        Object.defineProperties(this, {
            width: {
                enumerable: !0, get: function () {
                    return t
                }, set: function (e) {
                    if (!Bt(e)) throw new Error("Width must be between 0 and 100.");
                    t = e
                }
            }, lines: {
                enumerable: !0, get: function () {
                    return e
                }, set: function (t) {
                    if ("number" != typeof t) throw new TypeError("Lines must be set to a number.");
                    e = t
                }
            }, regionAnchorY: {
                enumerable: !0, get: function () {
                    return r
                }, set: function (t) {
                    if (!Bt(t)) throw new Error("RegionAnchorX must be between 0 and 100.");
                    r = t
                }
            }, regionAnchorX: {
                enumerable: !0, get: function () {
                    return n
                }, set: function (t) {
                    if (!Bt(t)) throw new Error("RegionAnchorY must be between 0 and 100.");
                    n = t
                }
            }, viewportAnchorY: {
                enumerable: !0, get: function () {
                    return o
                }, set: function (t) {
                    if (!Bt(t)) throw new Error("ViewportAnchorY must be between 0 and 100.");
                    o = t
                }
            }, viewportAnchorX: {
                enumerable: !0, get: function () {
                    return i
                }, set: function (t) {
                    if (!Bt(t)) throw new Error("ViewportAnchorX must be between 0 and 100.");
                    i = t
                }
            }, scroll: {
                enumerable: !0, get: function () {
                    return s
                }, set: function (t) {
                    var e = Rt(t);
                    if (!1 === e) throw new SyntaxError("An invalid or illegal string was specified.");
                    s = e
                }
            }
        })
    }

    function Vt(t, e, n, r) {
        var i = arguments.length > 4 && void 0 !== arguments[4] ? arguments[4] : {}, o = t.textTracks();
        i.kind = e, n && (i.label = n), r && (i.language = r), i.tech = t;
        var s = new Cr.text.TrackClass(i);
        return o.addTrack(s), s
    }

    function Ht(t, e) {
        Br[t] = Br[t] || [], Br[t].push(e)
    }

    function Wt(t, e, n) {
        t.setTimeout(function () {
            return Kt(e, Br[e.type], n, t)
        }, 1)
    }

    function Ut(t, e) {
        t.forEach(function (t) {
            return t.setTech && t.setTech(e)
        })
    }

    function zt(t, e, n) {
        return t.reduceRight(qt(n), e[n]())
    }

    function Xt(t, e, n, r) {
        return e[n](t.reduce(qt(n), r))
    }

    function qt(t) {
        return function (e, n) {
            return n[t] ? n[t](e) : e
        }
    }

    function Kt() {
        var t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {},
            e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : [], n = arguments[2], i = arguments[3],
            o = arguments.length > 4 && void 0 !== arguments[4] ? arguments[4] : [],
            s = arguments.length > 5 && void 0 !== arguments[5] && arguments[5], a = e[0], l = e.slice(1);
        if ("string" == typeof a) Kt(t, Br[a], n, i, o, s); else if (a) {
            var c = a(i);
            c.setSource(r({}, t), function (e, r) {
                if (e) return Kt(t, l, n, i, o, s);
                o.push(c), Kt(r, t.type === r.type ? l : Br[r.type], n, i, o, s)
            })
        } else l.length ? Kt(t, l, n, i, o, s) : s ? n(t, o) : Kt(t, Br["*"], n, i, o, !0)
    }

    function Yt(t, e) {
        return "rgba(" + parseInt(t[1] + t[1], 16) + "," + parseInt(t[2] + t[2], 16) + "," + parseInt(t[3] + t[3], 16) + "," + e + ")"
    }

    function Gt(t, e, n) {
        try {
            t.style[e] = n
        } catch (t) {
            return
        }
    }

    function $t(t) {
        var e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : t;
        t = t < 0 ? 0 : t;
        var n = Math.floor(t % 60), r = Math.floor(t / 60 % 60), i = Math.floor(t / 3600), o = Math.floor(e / 60 % 60),
            s = Math.floor(e / 3600);
        return (isNaN(t) || t === 1 / 0) && (i = r = n = "-"), i = i > 0 || s > 0 ? i + ":" : "", r = ((i || o >= 10) && r < 10 ? "0" + r : r) + ":", n = n < 10 ? "0" + n : n, i + r + n
    }

    function Jt(t, e) {
        if (e && (t = e(t)), t && "none" !== t) return t
    }

    function Qt(t, e) {
        return Jt(t.options[t.options.selectedIndex].value, e)
    }

    function Zt(t, e, n) {
        if (e) for (var r = 0; r < t.options.length; r++) if (Jt(t.options[r].value, n) === e) {
            t.selectedIndex = r;
            break
        }
    }

    function te(t, e, n) {
        var r = void 0;
        if ("string" == typeof t) {
            var o = te.getPlayers();
            if (0 === t.indexOf("#") && (t = t.slice(1)), o[t]) return e && Xe.warn('Player "' + t + '" is already initialised. Options will not be applied.'), n && o[t].ready(n), o[t];
            r = Ye("#" + t)
        } else r = t;
        if (!r || !r.nodeName) throw new TypeError("The element or ID supplied is not valid. (videojs)");
        if (r.player || lo.players[r.playerId]) return r.player || lo.players[r.playerId];
        e = e || {}, te.hooks("beforesetup").forEach(function (t) {
            var n = t(r, Z(e));
            if (!i(n) || Array.isArray(n)) return void Xe.error("please return an object in beforesetup hooks");
            e = Z(e, n)
        });
        var s = Tn.getComponent("Player"), a = new s(r, e, n);
        return te.hooks("setup").forEach(function (t) {
            return t(a)
        }), a
    }

    var ee, ne = "6.3.3",
        re = "undefined" != typeof window ? window : "undefined" != typeof global ? global : "undefined" != typeof self ? self : {};
    ee = "undefined" != typeof window ? window : void 0 !== re ? re : "undefined" != typeof self ? self : {};
    var ie, oe = ee, se = {}, ae = (Object.freeze || Object)({default: se}), le = ae && se || ae,
        ce = void 0 !== re ? re : "undefined" != typeof window ? window : {};
    "undefined" != typeof document ? ie = document : (ie = ce["__GLOBAL_DOCUMENT_CACHE@4"]) || (ie = ce["__GLOBAL_DOCUMENT_CACHE@4"] = le);
    var ue = ie, he = oe.navigator && oe.navigator.userAgent || "", pe = /AppleWebKit\/([\d.]+)/i.exec(he),
        de = pe ? parseFloat(pe.pop()) : null, fe = /iPad/i.test(he), ve = /iPhone/i.test(he) && !fe,
        ye = /iPod/i.test(he), ge = ve || fe || ye, me = function () {
            var t = he.match(/OS (\d+)_/i);
            return t && t[1] ? t[1] : null
        }(), _e = /Android/i.test(he), be = function () {
            var t = he.match(/Android (\d+)(?:\.(\d+))?(?:\.(\d+))*/i);
            if (!t) return null;
            var e = t[1] && parseFloat(t[1]), n = t[2] && parseFloat(t[2]);
            return e && n ? parseFloat(t[1] + "." + t[2]) : e || null
        }(), Te = _e && /webkit/i.test(he) && be < 2.3, Ce = _e && be < 5 && de < 537, ke = /Firefox/i.test(he),
        we = /Edge/i.test(he), Ee = !we && /Chrome/i.test(he), Se = function () {
            var t = he.match(/Chrome\/(\d+)/);
            return t && t[1] ? parseFloat(t[1]) : null
        }(), xe = /MSIE\s8\.0/.test(he), je = function () {
            var t = /MSIE\s(\d+)\.\d/.exec(he), e = t && parseFloat(t[1]);
            return !e && /Trident\/7.0/i.test(he) && /rv:11.0/.test(he) && (e = 11), e
        }(), Ae = /Safari/i.test(he) && !Ee && !_e && !we, Pe = Ae || ge,
        Ne = h() && ("ontouchstart" in oe || oe.DocumentTouch && oe.document instanceof oe.DocumentTouch),
        Oe = h() && "backgroundSize" in oe.document.createElement("video").style, Me = (Object.freeze || Object)({
            IS_IPAD: fe,
            IS_IPHONE: ve,
            IS_IPOD: ye,
            IS_IOS: ge,
            IOS_VERSION: me,
            IS_ANDROID: _e,
            ANDROID_VERSION: be,
            IS_OLD_ANDROID: Te,
            IS_NATIVE_ANDROID: Ce,
            IS_FIREFOX: ke,
            IS_EDGE: we,
            IS_CHROME: Ee,
            CHROME_VERSION: Se,
            IS_IE8: xe,
            IE_VERSION: je,
            IS_SAFARI: Ae,
            IS_ANY_SAFARI: Pe,
            TOUCH_ENABLED: Ne,
            BACKGROUND_SIZE_SUPPORTED: Oe
        }), Ie = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (t) {
            return typeof t
        } : function (t) {
            return t && "function" == typeof Symbol && t.constructor === Symbol && t !== Symbol.prototype ? "symbol" : typeof t
        }, De = function (t, e) {
            if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function")
        }, Le = function (t, e) {
            if ("function" != typeof e && null !== e) throw new TypeError("Super expression must either be null or a function, not " + typeof e);
            t.prototype = Object.create(e && e.prototype, {
                constructor: {
                    value: t,
                    enumerable: !1,
                    writable: !0,
                    configurable: !0
                }
            }), e && (Object.setPrototypeOf ? Object.setPrototypeOf(t, e) : t.__proto__ = e)
        }, Re = function (t, e) {
            if (!t) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
            return !e || "object" != typeof e && "function" != typeof e ? t : e
        }, Be = function (t, e) {
            return t.raw = e, t
        }, Fe = Object.prototype.toString, Ve = function (t) {
            return i(t) ? Object.keys(t) : []
        }, He = void 0, We = "all", Ue = [], ze = function (t, e) {
            var n = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : !!je && je < 11, r = He.levels[We],
                o = new RegExp("^(" + r + ")$");
            "log" !== t && e.unshift(t.toUpperCase() + ":"), Ue && Ue.push([].concat(e)), e.unshift("VIDEOJS:");
            var s = oe.console && oe.console[t];
            s && r && o.test(t) && (n && (e = e.map(function (t) {
                if (i(t) || Array.isArray(t)) try {
                    return JSON.stringify(t)
                } catch (e) {
                    return String(t)
                }
                return String(t)
            }).join(" ")), s.apply ? s[Array.isArray(e) ? "apply" : "call"](oe.console, e) : s(e))
        };
    He = function () {
        for (var t = arguments.length, e = Array(t), n = 0; n < t; n++) e[n] = arguments[n];
        ze("log", e)
    }, He.levels = {
        all: "log|warn|error",
        error: "error",
        off: "",
        warn: "warn|error",
        DEFAULT: We
    }, He.level = function (t) {
        if ("string" == typeof t) {
            if (!He.levels.hasOwnProperty(t)) throw new Error('"' + t + '" in not a valid log level');
            We = t
        }
        return We
    }, He.history = function () {
        return Ue ? [].concat(Ue) : []
    }, He.history.clear = function () {
        Ue && (Ue.length = 0)
    }, He.history.disable = function () {
        null !== Ue && (Ue.length = 0, Ue = null)
    }, He.history.enable = function () {
        null === Ue && (Ue = [])
    }, He.error = function () {
        for (var t = arguments.length, e = Array(t), n = 0; n < t; n++) e[n] = arguments[n];
        return ze("error", e)
    }, He.warn = function () {
        for (var t = arguments.length, e = Array(t), n = 0; n < t; n++) e[n] = arguments[n];
        return ze("warn", e)
    };
    var Xe = He, qe = function (t) {
            for (var e = "", n = 0; n < arguments.length; n++) e += s(t[n]) + (arguments[n + 1] || "");
            return e
        },
        Ke = Be(["Setting attributes in the second argument of createEl()\n                has been deprecated. Use the third argument instead.\n                createEl(type, properties, attributes). Attempting to set ", " to ", "."], ["Setting attributes in the second argument of createEl()\n                has been deprecated. Use the third argument instead.\n                createEl(type, properties, attributes). Attempting to set ", " to ", "."]),
        Ye = f("querySelector"), Ge = f("querySelectorAll"), $e = (Object.freeze || Object)({
            isReal: h,
            isEl: p,
            isInFrame: d,
            createEl: v,
            textContent: y,
            prependTo: g,
            hasClass: m,
            addClass: _,
            removeClass: b,
            toggleClass: T,
            setAttributes: C,
            getAttributes: k,
            getAttribute: w,
            setAttribute: E,
            removeAttribute: S,
            blockTextSelection: x,
            unblockTextSelection: j,
            getBoundingClientRect: A,
            findPosition: P,
            getPointerPosition: N,
            isTextNode: O,
            emptyEl: M,
            normalizeContent: I,
            appendContent: D,
            insertContent: L,
            $: Ye,
            $$: Ge
        }), Je = 1, Qe = {}, Ze = "vdata" + (new Date).getTime(), tn = !1;
    !function () {
        try {
            var t = Object.defineProperty({}, "passive", {
                get: function () {
                    tn = !0
                }
            });
            oe.addEventListener("test", null, t)
        } catch (t) {
        }
    }();
    var en = ["touchstart", "touchmove"],
        nn = (Object.freeze || Object)({fixEvent: U, on: z, off: X, trigger: q, one: K}), rn = !1, on = void 0,
        sn = function () {
            if (h()) {
                var t = ue.getElementsByTagName("video"), e = ue.getElementsByTagName("audio"), n = [];
                if (t && t.length > 0) for (var r = 0, i = t.length; r < i; r++) n.push(t[r]);
                if (e && e.length > 0) for (var o = 0, s = e.length; o < s; o++) n.push(e[o])
                ;
                if (n && n.length > 0) for (var a = 0, l = n.length; a < l; a++) {
                    var c = n[a];
                    if (!c || !c.getAttribute) {
                        Y(1);
                        break
                    }
                    if (void 0 === c.player) {
                        var u = c.getAttribute("data-setup");
                        null !== u && on(c)
                    }
                } else rn || Y(1)
            }
        };
    h() && "complete" === ue.readyState ? rn = !0 : K(oe, "load", function () {
        rn = !0
    });
    var an = function (t) {
        var e = ue.createElement("style");
        return e.className = t, e
    }, ln = function (t, e) {
        t.styleSheet ? t.styleSheet.cssText = e : t.textContent = e
    }, cn = function (t, e, n) {
        e.guid || (e.guid = R());
        var r = function () {
            return e.apply(t, arguments)
        };
        return r.guid = n ? n + "_" + e.guid : e.guid, r
    }, un = function (t, e) {
        var n = Date.now();
        return function () {
            var r = Date.now();
            r - n >= e && (t.apply(void 0, arguments), n = r)
        }
    }, hn = function () {
    };
    hn.prototype.allowedEvents_ = {}, hn.prototype.on = function (t, e) {
        var n = this.addEventListener;
        this.addEventListener = function () {
        }, z(this, t, e), this.addEventListener = n
    }, hn.prototype.addEventListener = hn.prototype.on, hn.prototype.off = function (t, e) {
        X(this, t, e)
    }, hn.prototype.removeEventListener = hn.prototype.off, hn.prototype.one = function (t, e) {
        var n = this.addEventListener;
        this.addEventListener = function () {
        }, K(this, t, e), this.addEventListener = n
    }, hn.prototype.trigger = function (t) {
        var e = t.type || t;
        "string" == typeof t && (t = {type: e}), t = U(t), this.allowedEvents_[e] && this["on" + e] && this["on" + e](t), q(this, t)
    }, hn.prototype.dispatchEvent = hn.prototype.trigger;
    var pn = function (t) {
        return t instanceof hn || !!t.eventBusEl_ && ["on", "one", "off", "trigger"].every(function (e) {
            return "function" == typeof t[e]
        })
    }, dn = function (t) {
        return "string" == typeof t && /\S/.test(t) || Array.isArray(t) && !!t.length
    }, fn = function (t) {
        if (!t.nodeName && !pn(t)) throw new Error("Invalid target; must be a DOM node or evented object.")
    }, vn = function (t) {
        if (!dn(t)) throw new Error("Invalid event type; must be a non-empty string or array.")
    }, yn = function (t) {
        if ("function" != typeof t) throw new Error("Invalid listener; must be a function.")
    }, gn = function (t, e) {
        var n = e.length < 3 || e[0] === t || e[0] === t.eventBusEl_, r = void 0, i = void 0, o = void 0;
        return n ? (r = t.eventBusEl_, e.length >= 3 && e.shift(), i = e[0], o = e[1]) : (r = e[0], i = e[1], o = e[2]), fn(r), vn(i), yn(o), o = cn(t, o), {
            isTargetingSelf: n,
            target: r,
            type: i,
            listener: o
        }
    }, mn = function (t, e, n, r) {
        fn(t), t.nodeName ? nn[e](t, n, r) : t[e](n, r)
    }, _n = {
        on: function () {
            for (var t = this, e = arguments.length, n = Array(e), r = 0; r < e; r++) n[r] = arguments[r];
            var i = gn(this, n), o = i.isTargetingSelf, s = i.target, a = i.type, l = i.listener;
            if (mn(s, "on", a, l), !o) {
                var c = function () {
                    return t.off(s, a, l)
                };
                c.guid = l.guid;
                var u = function () {
                    return t.off("dispose", c)
                };
                u.guid = l.guid, mn(this, "on", "dispose", c), mn(s, "on", "dispose", u)
            }
        }, one: function () {
            for (var t = this, e = arguments.length, n = Array(e), r = 0; r < e; r++) n[r] = arguments[r];
            var i = gn(this, n), o = i.isTargetingSelf, s = i.target, a = i.type, l = i.listener;
            if (o) mn(s, "one", a, l); else {
                var c = function e() {
                    for (var n = arguments.length, r = Array(n), i = 0; i < n; i++) r[i] = arguments[i];
                    t.off(s, a, e), l.apply(null, r)
                };
                c.guid = l.guid, mn(s, "one", a, c)
            }
        }, off: function (t, e, n) {
            if (!t || dn(t)) X(this.eventBusEl_, t, e); else {
                var r = t, i = e;
                fn(r), vn(i), yn(n), n = cn(this, n), this.off("dispose", n), r.nodeName ? (X(r, i, n), X(r, "dispose", n)) : pn(r) && (r.off(i, n), r.off("dispose", n))
            }
        }, trigger: function (t, e) {
            return q(this.eventBusEl_, t, e)
        }
    }, bn = {
        state: {}, setState: function (t) {
            var n = this;
            "function" == typeof t && (t = t());
            var r = void 0;
            return e(t, function (t, e) {
                n.state[e] !== t && (r = r || {}, r[e] = {from: n.state[e], to: t}), n.state[e] = t
            }), r && pn(this) && this.trigger({changes: r, type: "statechanged"}), r
        }
    }, Tn = function () {
        function t(e, n, r) {
            if (De(this, t), !e && this.play ? this.player_ = e = this : this.player_ = e, this.options_ = Z({}, this.options_), n = this.options_ = Z(this.options_, n), this.id_ = n.id || n.el && n.el.id, !this.id_) {
                var i = e && e.id && e.id() || "no_player";
                this.id_ = i + "_component_" + R()
            }
            this.name_ = n.name || null, n.el ? this.el_ = n.el : !1 !== n.createEl && (this.el_ = this.createEl()), G(this, {eventBusKey: this.el_ ? "el_" : null}), $(this, this.constructor.defaultState), this.children_ = [], this.childIndex_ = {}, this.childNameIndex_ = {}, !1 !== n.initChildren && this.initChildren(), this.ready(r), !1 !== n.reportTouchActivity && this.enableTouchActivity()
        }

        return t.prototype.dispose = function () {
            if (this.trigger({
                type: "dispose",
                bubbles: !1
            }), this.children_) for (var t = this.children_.length - 1; t >= 0; t--) this.children_[t].dispose && this.children_[t].dispose();
            this.children_ = null, this.childIndex_ = null, this.childNameIndex_ = null, this.el_ && (this.el_.parentNode && this.el_.parentNode.removeChild(this.el_), V(this.el_), this.el_ = null)
        }, t.prototype.player = function () {
            return this.player_
        }, t.prototype.options = function (t) {
            return Xe.warn("this.options() has been deprecated and will be moved to the constructor in 6.0"), t ? (this.options_ = Z(this.options_, t), this.options_) : this.options_
        }, t.prototype.el = function () {
            return this.el_
        }, t.prototype.createEl = function (t, e, n) {
            return v(t, e, n)
        }, t.prototype.localize = function (t, e) {
            var n = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : t,
                r = this.player_.language && this.player_.language(),
                i = this.player_.languages && this.player_.languages(), o = i && i[r], s = r && r.split("-")[0],
                a = i && i[s], l = n;
            return o && o[t] ? l = o[t] : a && a[t] && (l = a[t]), e && (l = l.replace(/\{(\d+)\}/g, function (t, n) {
                var r = e[n - 1], i = r;
                return void 0 === r && (i = t), i
            })), l
        }, t.prototype.contentEl = function () {
            return this.contentEl_ || this.el_
        }, t.prototype.id = function () {
            return this.id_
        }, t.prototype.name = function () {
            return this.name_
        }, t.prototype.children = function () {
            return this.children_
        }, t.prototype.getChildById = function (t) {
            return this.childIndex_[t]
        }, t.prototype.getChild = function (t) {
            if (t) return t = J(t), this.childNameIndex_[t]
        }, t.prototype.addChild = function (e) {
            var n = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {},
                r = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : this.children_.length, i = void 0,
                o = void 0;
            if ("string" == typeof e) {
                o = J(e);
                var s = n.componentClass || o;
                n.name = o;
                var a = t.getComponent(s);
                if (!a) throw new Error("Component " + s + " does not exist");
                if ("function" != typeof a) return null;
                i = new a(this.player_ || this, n)
            } else i = e;
            if (this.children_.splice(r, 0, i), "function" == typeof i.id && (this.childIndex_[i.id()] = i), o = o || i.name && J(i.name()), o && (this.childNameIndex_[o] = i), "function" == typeof i.el && i.el()) {
                var l = this.contentEl().children, c = l[r] || null;
                this.contentEl().insertBefore(i.el(), c)
            }
            return i
        }, t.prototype.removeChild = function (t) {
            if ("string" == typeof t && (t = this.getChild(t)), t && this.children_) {
                for (var e = !1, n = this.children_.length - 1; n >= 0; n--) if (this.children_[n] === t) {
                    e = !0, this.children_.splice(n, 1);
                    break
                }
                if (e) {
                    this.childIndex_[t.id()] = null, this.childNameIndex_[t.name()] = null;
                    var r = t.el();
                    r && r.parentNode === this.contentEl() && this.contentEl().removeChild(t.el())
                }
            }
        }, t.prototype.initChildren = function () {
            var e = this, n = this.options_.children;
            if (n) {
                var r = this.options_, i = function (t) {
                    var n = t.name, i = t.opts;
                    if (void 0 !== r[n] && (i = r[n]), !1 !== i) {
                        !0 === i && (i = {}), i.playerOptions = e.options_.playerOptions;
                        var o = e.addChild(n, i);
                        o && (e[n] = o)
                    }
                }, o = void 0, s = t.getComponent("Tech");
                o = Array.isArray(n) ? n : Object.keys(n), o.concat(Object.keys(this.options_).filter(function (t) {
                    return !o.some(function (e) {
                        return "string" == typeof e ? t === e : t === e.name
                    })
                })).map(function (t) {
                    var r = void 0, i = void 0;
                    return "string" == typeof t ? (r = t, i = n[r] || e.options_[r] || {}) : (r = t.name, i = t), {
                        name: r,
                        opts: i
                    }
                }).filter(function (e) {
                    var n = t.getComponent(e.opts.componentClass || J(e.name));
                    return n && !s.isTech(n)
                }).forEach(i)
            }
        }, t.prototype.buildCSSClass = function () {
            return ""
        }, t.prototype.ready = function (t) {
            var e = arguments.length > 1 && void 0 !== arguments[1] && arguments[1];
            t && (this.isReady_ ? e ? t.call(this) : this.setTimeout(t, 1) : (this.readyQueue_ = this.readyQueue_ || [], this.readyQueue_.push(t)))
        }, t.prototype.triggerReady = function () {
            this.isReady_ = !0, this.setTimeout(function () {
                var t = this.readyQueue_;
                this.readyQueue_ = [], t && t.length > 0 && t.forEach(function (t) {
                    t.call(this)
                }, this), this.trigger("ready")
            }, 1)
        }, t.prototype.$ = function (t, e) {
            return Ye(t, e || this.contentEl())
        }, t.prototype.$$ = function (t, e) {
            return Ge(t, e || this.contentEl())
        }, t.prototype.hasClass = function (t) {
            return m(this.el_, t)
        }, t.prototype.addClass = function (t) {
            _(this.el_, t)
        }, t.prototype.removeClass = function (t) {
            b(this.el_, t)
        }, t.prototype.toggleClass = function (t, e) {
            T(this.el_, t, e)
        }, t.prototype.show = function () {
            this.removeClass("vjs-hidden")
        }, t.prototype.hide = function () {
            this.addClass("vjs-hidden")
        }, t.prototype.lockShowing = function () {
            this.addClass("vjs-lock-showing")
        }, t.prototype.unlockShowing = function () {
            this.removeClass("vjs-lock-showing")
        }, t.prototype.getAttribute = function (t) {
            return w(this.el_, t)
        }, t.prototype.setAttribute = function (t, e) {
            E(this.el_, t, e)
        }, t.prototype.removeAttribute = function (t) {
            S(this.el_, t)
        }, t.prototype.width = function (t, e) {
            return this.dimension("width", t, e)
        }, t.prototype.height = function (t, e) {
            return this.dimension("height", t, e)
        }, t.prototype.dimensions = function (t, e) {
            this.width(t, !0), this.height(e)
        }, t.prototype.dimension = function (t, e, n) {
            if (void 0 !== e) return null !== e && e === e || (e = 0), -1 !== ("" + e).indexOf("%") || -1 !== ("" + e).indexOf("px") ? this.el_.style[t] = e : this.el_.style[t] = "auto" === e ? "" : e + "px", void(n || this.trigger("componentresize"));
            if (!this.el_) return 0;
            var r = this.el_.style[t], i = r.indexOf("px");
            return -1 !== i ? parseInt(r.slice(0, i), 10) : parseInt(this.el_["offset" + J(t)], 10)
        }, t.prototype.currentDimension = function (t) {
            var e = 0;
            if ("width" !== t && "height" !== t) throw new Error("currentDimension only accepts width or height value");
            if ("function" == typeof oe.getComputedStyle) {
                var n = oe.getComputedStyle(this.el_);
                e = n.getPropertyValue(t) || n[t]
            }
            if (0 === (e = parseFloat(e))) {
                var r = "offset" + J(t);
                e = this.el_[r]
            }
            return e
        }, t.prototype.currentDimensions = function () {
            return {width: this.currentDimension("width"), height: this.currentDimension("height")}
        }, t.prototype.currentWidth = function () {
            return this.currentDimension("width")
        }, t.prototype.currentHeight = function () {
            return this.currentDimension("height")
        }, t.prototype.focus = function () {
            this.el_.focus()
        }, t.prototype.blur = function () {
            this.el_.blur()
        }, t.prototype.emitTapEvents = function () {
            var t = 0, e = null, n = void 0;
            this.on("touchstart", function (r) {
                1 === r.touches.length && (e = {
                    pageX: r.touches[0].pageX,
                    pageY: r.touches[0].pageY
                }, t = (new Date).getTime(), n = !0)
            }), this.on("touchmove", function (t) {
                if (t.touches.length > 1) n = !1; else if (e) {
                    var r = t.touches[0].pageX - e.pageX, i = t.touches[0].pageY - e.pageY,
                        o = Math.sqrt(r * r + i * i);
                    o > 10 && (n = !1)
                }
            });
            var r = function () {
                n = !1
            };
            this.on("touchleave", r), this.on("touchcancel", r), this.on("touchend", function (r) {
                if (e = null, !0 === n) {
                    (new Date).getTime() - t < 200 && (r.preventDefault(), this.trigger("tap"))
                }
            })
        }, t.prototype.enableTouchActivity = function () {
            if (this.player() && this.player().reportUserActivity) {
                var t = cn(this.player(), this.player().reportUserActivity), e = void 0;
                this.on("touchstart", function () {
                    t(), this.clearInterval(e), e = this.setInterval(t, 250)
                });
                var n = function (n) {
                    t(), this.clearInterval(e)
                };
                this.on("touchmove", t), this.on("touchend", n), this.on("touchcancel", n)
            }
        }, t.prototype.setTimeout = function (t, e) {
            t = cn(this, t);
            var n = oe.setTimeout(t, e), r = function () {
                this.clearTimeout(n)
            };
            return r.guid = "vjs-timeout-" + n, this.on("dispose", r), n
        }, t.prototype.clearTimeout = function (t) {
            oe.clearTimeout(t);
            var e = function () {
            };
            return e.guid = "vjs-timeout-" + t, this.off("dispose", e), t
        }, t.prototype.setInterval = function (t, e) {
            t = cn(this, t);
            var n = oe.setInterval(t, e), r = function () {
                this.clearInterval(n)
            };
            return r.guid = "vjs-interval-" + n, this.on("dispose", r), n
        }, t.prototype.clearInterval = function (t) {
            oe.clearInterval(t);
            var e = function () {
            };
            return e.guid = "vjs-interval-" + t, this.off("dispose", e), t
        }, t.prototype.requestAnimationFrame = function (t) {
            var e = this;
            if (this.supportsRaf_) {
                t = cn(this, t);
                var n = oe.requestAnimationFrame(t), r = function () {
                    return e.cancelAnimationFrame(n)
                };
                return r.guid = "vjs-raf-" + n, this.on("dispose", r), n
            }
            return this.setTimeout(t, 1e3 / 60)
        }, t.prototype.cancelAnimationFrame = function (t) {
            if (this.supportsRaf_) {
                oe.cancelAnimationFrame(t);
                var e = function () {
                };
                return e.guid = "vjs-raf-" + t, this.off("dispose", e), t
            }
            return this.clearTimeout(t)
        }, t.registerComponent = function (e, n) {
            if ("string" != typeof e || !e) throw new Error('Illegal component name, "' + e + '"; must be a non-empty string.');
            var r = t.getComponent("Tech"), i = r && r.isTech(n), o = t === n || t.prototype.isPrototypeOf(n.prototype);
            if (i || !o) {
                var s = void 0;
                throw s = i ? "techs must be registered using Tech.registerTech()" : "must be a Component subclass", new Error('Illegal component, "' + e + '"; ' + s + ".")
            }
            e = J(e), t.components_ || (t.components_ = {});
            var a = t.getComponent("Player");
            if ("Player" === e && a && a.players) {
                var l = a.players, c = Object.keys(l);
                if (l && c.length > 0 && c.map(function (t) {
                    return l[t]
                }).every(Boolean)) throw new Error("Can not register Player component after player has been created.")
            }
            return t.components_[e] = n, n
        }, t.getComponent = function (e) {
            if (e) return e = J(e), t.components_ && t.components_[e] ? t.components_[e] : void 0
        }, t
    }();
    Tn.prototype.supportsRaf_ = "function" == typeof oe.requestAnimationFrame && "function" == typeof oe.cancelAnimationFrame, Tn.registerComponent("Component", Tn);
    for (var Cn = {}, kn = [["requestFullscreen", "exitFullscreen", "fullscreenElement", "fullscreenEnabled", "fullscreenchange", "fullscreenerror"], ["webkitRequestFullscreen", "webkitExitFullscreen", "webkitFullscreenElement", "webkitFullscreenEnabled", "webkitfullscreenchange", "webkitfullscreenerror"], ["webkitRequestFullScreen", "webkitCancelFullScreen", "webkitCurrentFullScreenElement", "webkitCancelFullScreen", "webkitfullscreenchange", "webkitfullscreenerror"], ["mozRequestFullScreen", "mozCancelFullScreen", "mozFullScreenElement", "mozFullScreenEnabled", "mozfullscreenchange", "mozfullscreenerror"], ["msRequestFullscreen", "msExitFullscreen", "msFullscreenElement", "msFullscreenEnabled", "MSFullscreenChange", "MSFullscreenError"]], wn = kn[0], En = void 0, Sn = 0; Sn < kn.length; Sn++) if (kn[Sn][1] in ue) {
        En = kn[Sn];
        break
    }
    if (En) for (var xn = 0; xn < En.length; xn++) Cn[wn[xn]] = En[xn];
    ot.prototype.code = 0, ot.prototype.message = "", ot.prototype.status = null, ot.errorTypes = ["MEDIA_ERR_CUSTOM", "MEDIA_ERR_ABORTED", "MEDIA_ERR_NETWORK", "MEDIA_ERR_DECODE", "MEDIA_ERR_SRC_NOT_SUPPORTED", "MEDIA_ERR_ENCRYPTED"], ot.defaultMessages = {
        1: "You aborted the media playback",
        2: "A network error caused the media download to fail part-way.",
        3: "The media playback was aborted due to a corruption problem or because the media used features your browser did not support.",
        4: "The media could not be loaded, either because the server or network failed or because the format is not supported.",
        5: "The media is encrypted and we do not have the keys to decrypt it."
    };
    for (var jn = 0; jn < ot.errorTypes.length; jn++) ot[ot.errorTypes[jn]] = jn, ot.prototype[ot.errorTypes[jn]] = jn;
    var An = st, Pn = function (t) {
        return ["kind", "label", "language", "id", "inBandMetadataTrackDispatchType", "mode", "src"].reduce(function (e, n, r) {
            return t[n] && (e[n] = t[n]), e
        }, {
            cues: t.cues && Array.prototype.map.call(t.cues, function (t) {
                return {startTime: t.startTime, endTime: t.endTime, text: t.text, id: t.id}
            })
        })
    }, Nn = function (t) {
        var e = t.$$("track"), n = Array.prototype.map.call(e, function (t) {
            return t.track
        });
        return Array.prototype.map.call(e, function (t) {
            var e = Pn(t.track);
            return t.src && (e.src = t.src), e
        }).concat(Array.prototype.filter.call(t.textTracks(), function (t) {
            return -1 === n.indexOf(t)
        }).map(Pn))
    }, On = function (t, e) {
        return t.forEach(function (t) {
            var n = e.addRemoteTextTrack(t).track;
            !t.src && t.cues && t.cues.forEach(function (t) {
                return n.addCue(t)
            })
        }), e.textTracks()
    }, Mn = {textTracksToJson: Nn, jsonToTextTracks: On, trackToJson_: Pn}, In = "vjs-modal-dialog", Dn = function (t) {
        function e(n, r) {
            De(this, e);
            var i = Re(this, t.call(this, n, r));
            return i.opened_ = i.hasBeenOpened_ = i.hasBeenFilled_ = !1, i.closeable(!i.options_.uncloseable), i.content(i.options_.content), i.contentEl_ = v("div", {className: In + "-content"}, {role: "document"}), i.descEl_ = v("p", {
                className: In + "-description vjs-control-text",
                id: i.el().getAttribute("aria-describedby")
            }), y(i.descEl_, i.description()), i.el_.appendChild(i.descEl_), i.el_.appendChild(i.contentEl_), i
        }

        return Le(e, t), e.prototype.createEl = function () {
            return t.prototype.createEl.call(this, "div", {
                className: this.buildCSSClass(),
                tabIndex: -1
            }, {
                "aria-describedby": this.id() + "_description",
                "aria-hidden": "true",
                "aria-label": this.label(),
                role: "dialog"
            })
        }, e.prototype.buildCSSClass = function () {
            return In + " vjs-hidden " + t.prototype.buildCSSClass.call(this)
        }, e.prototype.handleKeyPress = function (t) {
            27 === t.which && this.closeable() && this.close()
        }, e.prototype.label = function () {
            return this.localize(this.options_.label || "Modal Window")
        }, e.prototype.description = function () {
            var t = this.options_.description || this.localize("This is a modal window.");
            return this.closeable() && (t += " " + this.localize("This modal can be closed by pressing the Escape key or activating the close button.")), t
        }, e.prototype.open = function () {
            if (!this.opened_) {
                var t = this.player();
                this.trigger("beforemodalopen"), this.opened_ = !0, (this.options_.fillAlways || !this.hasBeenOpened_ && !this.hasBeenFilled_) && this.fill(), this.wasPlaying_ = !t.paused(), this.options_.pauseOnOpen && this.wasPlaying_ && t.pause(), this.closeable() && this.on(this.el_.ownerDocument, "keydown", cn(this, this.handleKeyPress)), t.controls(!1), this.show(), this.conditionalFocus_(), this.el().setAttribute("aria-hidden", "false"), this.trigger("modalopen"), this.hasBeenOpened_ = !0
            }
        }, e.prototype.opened = function (t) {
            return "boolean" == typeof t && this[t ? "open" : "close"](), this.opened_
        }, e.prototype.close = function () {
            if (this.opened_) {
                var t = this.player();
                this.trigger("beforemodalclose"), this.opened_ = !1, this.wasPlaying_ && this.options_.pauseOnOpen && t.play(), this.closeable() && this.off(this.el_.ownerDocument, "keydown", cn(this, this.handleKeyPress)), t.controls(!0), this.hide(), this.el().setAttribute("aria-hidden", "true"), this.trigger("modalclose"), this.conditionalBlur_(), this.options_.temporary && this.dispose()
            }
        }, e.prototype.closeable = function (t) {
            if ("boolean" == typeof t) {
                var e = this.closeable_ = !!t, n = this.getChild("closeButton");
                if (e && !n) {
                    var r = this.contentEl_;
                    this.contentEl_ = this.el_, n = this.addChild("closeButton", {controlText: "Close Modal Dialog"}), this.contentEl_ = r, this.on(n, "close", this.close)
                }
                !e && n && (this.off(n, "close", this.close), this.removeChild(n), n.dispose())
            }
            return this.closeable_
        }, e.prototype.fill = function () {
            this.fillWith(this.content())
        }, e.prototype.fillWith = function (t) {
            var e = this.contentEl(), n = e.parentNode, r = e.nextSibling;
            this.trigger("beforemodalfill"), this.hasBeenFilled_ = !0, n.removeChild(e), this.empty(), L(e, t), this.trigger("modalfill"), r ? n.insertBefore(e, r) : n.appendChild(e);
            var i = this.getChild("closeButton");
            i && n.appendChild(i.el_)
        }, e.prototype.empty = function () {
            this.trigger("beforemodalempty"), M(this.contentEl()), this.trigger("modalempty")
        }, e.prototype.content = function (t) {
            return void 0 !== t && (this.content_ = t), this.content_
        }, e.prototype.conditionalFocus_ = function () {
            var t = ue.activeElement, e = this.player_.el_;
            this.previouslyActiveEl_ = null, (e.contains(t) || e === t) && (this.previouslyActiveEl_ = t, this.focus(), this.on(ue, "keydown", this.handleKeyDown))
        }, e.prototype.conditionalBlur_ = function () {
            this.previouslyActiveEl_ && (this.previouslyActiveEl_.focus(), this.previouslyActiveEl_ = null), this.off(ue, "keydown", this.handleKeyDown)
        }, e.prototype.handleKeyDown = function (t) {
            if (9 === t.which) {
                for (var e = this.focusableEls_(), n = this.el_.querySelector(":focus"), r = void 0, i = 0; i < e.length; i++) if (n === e[i]) {
                    r = i;
                    break
                }
                ue.activeElement === this.el_ && (r = 0), t.shiftKey && 0 === r ? (e[e.length - 1].focus(), t.preventDefault()) : t.shiftKey || r !== e.length - 1 || (e[0].focus(), t.preventDefault())
            }
        }, e.prototype.focusableEls_ = function () {
            var t = this.el_.querySelectorAll("*");
            return Array.prototype.filter.call(t, function (t) {
                return (t instanceof oe.HTMLAnchorElement || t instanceof oe.HTMLAreaElement) && t.hasAttribute("href") || (t instanceof oe.HTMLInputElement || t instanceof oe.HTMLSelectElement || t instanceof oe.HTMLTextAreaElement || t instanceof oe.HTMLButtonElement) && !t.hasAttribute("disabled") || t instanceof oe.HTMLIFrameElement || t instanceof oe.HTMLObjectElement || t instanceof oe.HTMLEmbedElement || t.hasAttribute("tabindex") && -1 !== t.getAttribute("tabindex") || t.hasAttribute("contenteditable")
            })
        }, e
    }(Tn);
    Dn.prototype.options_ = {pauseOnOpen: !0, temporary: !0}, Tn.registerComponent("ModalDialog", Dn);
    var Ln = function (t) {
        function e() {
            var n, r = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : [],
                i = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : null;
            De(this, e);
            var o = Re(this, t.call(this));
            if (!i && (i = o, xe)) {
                i = ue.createElement("custom");
                for (var s in e.prototype) "constructor" !== s && (i[s] = e.prototype[s])
            }
            i.tracks_ = [], Object.defineProperty(i, "length", {
                get: function () {
                    return this.tracks_.length
                }
            });
            for (var a = 0; a < r.length; a++) i.addTrack(r[a]);
            return n = i, Re(o, n)
        }

        return Le(e, t), e.prototype.addTrack = function (t) {
            var e = this.tracks_.length;
            "" + e in this || Object.defineProperty(this, e, {
                get: function () {
                    return this.tracks_[e]
                }
            }), -1 === this.tracks_.indexOf(t) && (this.tracks_.push(t), this.trigger({track: t, type: "addtrack"}))
        }, e.prototype.removeTrack = function (t) {
            for (var e = void 0, n = 0, r = this.length; n < r; n++) if (this[n] === t) {
                e = this[n], e.off && e.off(), this.tracks_.splice(n, 1);
                break
            }
            e && this.trigger({track: e, type: "removetrack"})
        }, e.prototype.getTrackById = function (t) {
            for (var e = null, n = 0, r = this.length; n < r; n++) {
                var i = this[n];
                if (i.id === t) {
                    e = i;
                    break
                }
            }
            return e
        }, e
    }(hn);
    Ln.prototype.allowedEvents_ = {change: "change", addtrack: "addtrack", removetrack: "removetrack"};
    for (var Rn in Ln.prototype.allowedEvents_) Ln.prototype["on" + Rn] = null;
    var Bn = function (t, e) {
            for (var n = 0; n < t.length; n++) Object.keys(t[n]).length && e.id !== t[n].id && (t[n].enabled = !1)
        }, Fn = function (t) {
            function e() {
                var n, r, i = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : [];
                De(this, e);
                for (var o = void 0, s = i.length - 1; s >= 0; s--) if (i[s].enabled) {
                    Bn(i, i[s]);
                    break
                }
                if (xe) {
                    o = ue.createElement("custom");
                    for (var a in Ln.prototype) "constructor" !== a && (o[a] = Ln.prototype[a]);
                    for (var l in e.prototype) "constructor" !== l && (o[l] = e.prototype[l])
                }
                return o = n = Re(this, t.call(this, i, o)), o.changing_ = !1, r = o, Re(n, r)
            }

            return Le(e, t), e.prototype.addTrack = function (e) {
                var n = this;
                e.enabled && Bn(this, e), t.prototype.addTrack.call(this, e), e.addEventListener && e.addEventListener("enabledchange", function () {
                    n.changing_ || (n.changing_ = !0, Bn(n, e), n.changing_ = !1, n.trigger("change"))
                })
            }, e
        }(Ln), Vn = function (t, e) {
            for (var n = 0; n < t.length; n++) Object.keys(t[n]).length && e.id !== t[n].id && (t[n].selected = !1)
        }, Hn = function (t) {
            function e() {
                var n, r, i = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : [];
                De(this, e);
                for (var o = void 0, s = i.length - 1; s >= 0; s--) if (i[s].selected) {
                    Vn(i, i[s]);
                    break
                }
                if (xe) {
                    o = ue.createElement("custom");
                    for (var a in Ln.prototype) "constructor" !== a && (o[a] = Ln.prototype[a]);
                    for (var l in e.prototype) "constructor" !== l && (o[l] = e.prototype[l])
                }
                return o = n = Re(this, t.call(this, i, o)), o.changing_ = !1, Object.defineProperty(o, "selectedIndex", {
                    get: function () {
                        for (var t = 0; t < this.length; t++) if (this[t].selected) return t;
                        return -1
                    }, set: function () {
                    }
                }), r = o, Re(n, r)
            }

            return Le(e, t), e.prototype.addTrack = function (e) {
                var n = this;
                e.selected && Vn(this, e), t.prototype.addTrack.call(this, e), e.addEventListener && e.addEventListener("selectedchange", function () {
                    n.changing_ || (n.changing_ = !0, Vn(n, e), n.changing_ = !1, n.trigger("change"))
                })
            }, e
        }(Ln), Wn = function (t) {
            function e() {
                var n, r, i = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : [];
                De(this, e);
                var o = void 0;
                if (xe) {
                    o = ue.createElement("custom");
                    for (var s in Ln.prototype) "constructor" !== s && (o[s] = Ln.prototype[s]);
                    for (var a in e.prototype) "constructor" !== a && (o[a] = e.prototype[a])
                }
                return o = n = Re(this, t.call(this, i, o)), r = o, Re(n, r)
            }

            return Le(e, t), e.prototype.addTrack = function (e) {
                t.prototype.addTrack.call(this, e), e.addEventListener("modechange", cn(this, function () {
                    this.trigger("change")
                })), -1 === ["metadata", "chapters"].indexOf(e.kind) && e.addEventListener("modechange", cn(this, function () {
                    this.trigger("selectedlanguagechange")
                }))
            }, e
        }(Ln), Un = function () {
            function t() {
                var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : [];
                De(this, t);
                var n = this;
                if (xe) {
                    n = ue.createElement("custom");
                    for (var r in t.prototype) "constructor" !== r && (n[r] = t.prototype[r])
                }
                n.trackElements_ = [], Object.defineProperty(n, "length", {
                    get: function () {
                        return this.trackElements_.length
                    }
                });
                for (var i = 0, o = e.length; i < o; i++) n.addTrackElement_(e[i]);
                if (xe) return n
            }

            return t.prototype.addTrackElement_ = function (t) {
                var e = this.trackElements_.length;
                "" + e in this || Object.defineProperty(this, e, {
                    get: function () {
                        return this.trackElements_[e]
                    }
                }), -1 === this.trackElements_.indexOf(t) && this.trackElements_.push(t)
            }, t.prototype.getTrackElementByTrack_ = function (t) {
                for (var e = void 0, n = 0, r = this.trackElements_.length; n < r; n++) if (t === this.trackElements_[n].track) {
                    e = this.trackElements_[n];
                    break
                }
                return e
            }, t.prototype.removeTrackElement_ = function (t) {
                for (var e = 0, n = this.trackElements_.length; e < n; e++) if (t === this.trackElements_[e]) {
                    this.trackElements_.splice(e, 1);
                    break
                }
            }, t
        }(), zn = function () {
            function t(e) {
                De(this, t);
                var n = this;
                if (xe) {
                    n = ue.createElement("custom");
                    for (var r in t.prototype) "constructor" !== r && (n[r] = t.prototype[r])
                }
                if (t.prototype.setCues_.call(n, e), Object.defineProperty(n, "length", {
                    get: function () {
                        return this.length_
                    }
                }), xe) return n
            }

            return t.prototype.setCues_ = function (t) {
                var e = this.length || 0, n = 0, r = t.length;
                this.cues_ = t, this.length_ = t.length;
                var i = function (t) {
                    "" + t in this || Object.defineProperty(this, "" + t, {
                        get: function () {
                            return this.cues_[t]
                        }
                    })
                };
                if (e < r) for (n = e; n < r; n++) i.call(this, n)
            }, t.prototype.getCueById = function (t) {
                for (var e = null, n = 0, r = this.length; n < r; n++) {
                    var i = this[n];
                    if (i.id === t) {
                        e = i;
                        break
                    }
                }
                return e
            }, t
        }(), Xn = {
            alternative: "alternative",
            captions: "captions",
            main: "main",
            sign: "sign",
            subtitles: "subtitles",
            commentary: "commentary"
        }, qn = {
            alternative: "alternative",
            descriptions: "descriptions",
            main: "main",
            "main-desc": "main-desc",
            translation: "translation",
            commentary: "commentary"
        }, Kn = {
            subtitles: "subtitles",
            captions: "captions",
            descriptions: "descriptions",
            chapters: "chapters",
            metadata: "metadata"
        }, Yn = {disabled: "disabled", hidden: "hidden", showing: "showing"}, Gn = function (t) {
            function e() {
                var n, r = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {};
                De(this, e);
                var i = Re(this, t.call(this)), o = i;
                if (xe) {
                    o = ue.createElement("custom");
                    for (var s in e.prototype) "constructor" !== s && (o[s] = e.prototype[s])
                }
                var a = {
                    id: r.id || "vjs_track_" + R(),
                    kind: r.kind || "",
                    label: r.label || "",
                    language: r.language || ""
                };
                for (var l in a) !function (t) {
                    Object.defineProperty(o, t, {
                        get: function () {
                            return a[t]
                        }, set: function () {
                        }
                    })
                }(l);
                return n = o, Re(i, n)
            }

            return Le(e, t), e
        }(hn), $n = function (t) {
            var e = ["protocol", "hostname", "port", "pathname", "search", "hash", "host"], n = ue.createElement("a");
            n.href = t;
            var r = "" === n.host && "file:" !== n.protocol, i = void 0;
            r && (i = ue.createElement("div"), i.innerHTML = '<a href="' + t + '"></a>', n = i.firstChild, i.setAttribute("style", "display:none; position:absolute;"), ue.body.appendChild(i));
            for (var o = {}, s = 0; s < e.length; s++) o[e[s]] = n[e[s]];
            return "http:" === o.protocol && (o.host = o.host.replace(/:80$/, "")), "https:" === o.protocol && (o.host = o.host.replace(/:443$/, "")), r && ue.body.removeChild(i), o
        }, Jn = function (t) {
            if (!t.match(/^https?:\/\//)) {
                var e = ue.createElement("div");
                e.innerHTML = '<a href="' + t + '">x</a>', t = e.firstChild.href
            }
            return t
        }, Qn = function (t) {
            if ("string" == typeof t) {
                var e = /^(\/?)([\s\S]*?)((?:\.{1,2}|[^\/]+?)(\.([^\.\/\?]+)))(?:[\/]*|[\?].*)$/i, n = e.exec(t);
                if (n) return n.pop().toLowerCase()
            }
            return ""
        }, Zn = function (t) {
            var e = oe.location, n = $n(t);
            return (":" === n.protocol ? e.protocol : n.protocol) + n.host !== e.protocol + e.host
        }, tr = (Object.freeze || Object)({parseUrl: $n, getAbsoluteURL: Jn, getFileExtension: Qn, isCrossOrigin: Zn}),
        er = at, nr = Object.prototype.toString, rr = t(function (t, e) {
            function n(t) {
                return t.replace(/^\s*|\s*$/g, "")
            }

            e = t.exports = n, e.left = function (t) {
                return t.replace(/^\s*/, "")
            }, e.right = function (t) {
                return t.replace(/\s*$/, "")
            }
        }), ir = lt, or = Object.prototype.toString, sr = Object.prototype.hasOwnProperty, ar = function (t) {
            return "[object Array]" === Object.prototype.toString.call(t)
        }, lr = function (t) {
            if (!t) return {};
            var e = {};
            return ir(rr(t).split("\n"), function (t) {
                var n = t.indexOf(":"), r = rr(t.slice(0, n)).toLowerCase(), i = rr(t.slice(n + 1));
                void 0 === e[r] ? e[r] = i : ar(e[r]) ? e[r].push(i) : e[r] = [e[r], i]
            }), e
        }, cr = pt, ur = Object.prototype.hasOwnProperty, hr = vt;
    vt.XMLHttpRequest = oe.XMLHttpRequest || mt, vt.XDomainRequest = "withCredentials" in new vt.XMLHttpRequest ? vt.XMLHttpRequest : oe.XDomainRequest, function (t, e) {
        for (var n = 0; n < t.length; n++) e(t[n])
    }(["get", "put", "post", "patch", "head", "delete"], function (t) {
        vt["delete" === t ? "del" : t] = function (e, n, r) {
            return n = ft(e, n, r), n.method = t.toUpperCase(), yt(n)
        }
    });
    var pr = function (t, e) {
        var n = new oe.WebVTT.Parser(oe, oe.vttjs, oe.WebVTT.StringDecoder()), r = [];
        n.oncue = function (t) {
            e.addCue(t)
        }, n.onparsingerror = function (t) {
            r.push(t)
        }, n.onflush = function () {
            e.trigger({type: "loadeddata", target: e})
        }, n.parse(t), r.length > 0 && (oe.console && oe.console.groupCollapsed && oe.console.groupCollapsed("Text Track parsing errors for " + e.src), r.forEach(function (t) {
            return Xe.error(t)
        }), oe.console && oe.console.groupEnd && oe.console.groupEnd()), n.flush()
    }, dr = function (t, e) {
        var n = {uri: t}, r = Zn(t);
        r && (n.cors = r), hr(n, cn(this, function (t, n, r) {
            if (t) return Xe.error(t, n);
            if (e.loaded_ = !0, "function" != typeof oe.WebVTT) {
                if (e.tech_) {
                    var i = function () {
                        return pr(r, e)
                    };
                    e.tech_.on("vttjsloaded", i), e.tech_.on("vttjserror", function () {
                        Xe.error("vttjs failed to load, stopping trying to process " + e.src), e.tech_.off("vttjsloaded", i)
                    })
                }
            } else pr(r, e)
        }))
    }, fr = function (t) {
        function e() {
            var n, r, i = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {};
            if (De(this, e), !i.tech) throw new Error("A tech was not provided.");
            var o = Z(i, {kind: Kn[i.kind] || "subtitles", language: i.language || i.srclang || ""}),
                s = Yn[o.mode] || "disabled", a = o.default;
            "metadata" !== o.kind && "chapters" !== o.kind || (s = "hidden");
            var l = n = Re(this, t.call(this, o));
            if (l.tech_ = o.tech, xe) for (var c in e.prototype) "constructor" !== c && (l[c] = e.prototype[c]);
            l.cues_ = [], l.activeCues_ = [];
            var u = new zn(l.cues_), h = new zn(l.activeCues_), p = !1, d = cn(l, function () {
                this.activeCues, p && (this.trigger("cuechange"), p = !1)
            });
            return "disabled" !== s && l.tech_.ready(function () {
                l.tech_.on("timeupdate", d)
            }, !0), Object.defineProperty(l, "default", {
                get: function () {
                    return a
                }, set: function () {
                }
            }), Object.defineProperty(l, "mode", {
                get: function () {
                    return s
                }, set: function (t) {
                    var e = this;
                    Yn[t] && (s = t, "showing" === s && this.tech_.ready(function () {
                        e.tech_.on("timeupdate", d)
                    }, !0), this.trigger("modechange"))
                }
            }), Object.defineProperty(l, "cues", {
                get: function () {
                    return this.loaded_ ? u : null
                }, set: function () {
                }
            }), Object.defineProperty(l, "activeCues", {
                get: function () {
                    if (!this.loaded_) return null;
                    if (0 === this.cues.length) return h;
                    for (var t = this.tech_.currentTime(), e = [], n = 0, r = this.cues.length; n < r; n++) {
                        var i = this.cues[n];
                        i.startTime <= t && i.endTime >= t ? e.push(i) : i.startTime === i.endTime && i.startTime <= t && i.startTime + .5 >= t && e.push(i)
                    }
                    if (p = !1, e.length !== this.activeCues_.length) p = !0; else for (var o = 0; o < e.length; o++) -1 === this.activeCues_.indexOf(e[o]) && (p = !0);
                    return this.activeCues_ = e, h.setCues_(this.activeCues_), h
                }, set: function () {
                }
            }), o.src ? (l.src = o.src, dr(o.src, l)) : l.loaded_ = !0, r = l, Re(n, r)
        }

        return Le(e, t), e.prototype.addCue = function (t) {
            var e = t;
            if (oe.vttjs && !(t instanceof oe.vttjs.VTTCue)) {
                e = new oe.vttjs.VTTCue(t.startTime, t.endTime, t.text);
                for (var n in t) n in e || (e[n] = t[n]);
                e.id = t.id, e.originalCue_ = t
            }
            for (var r = this.tech_.textTracks(), i = 0; i < r.length; i++) r[i] !== this && r[i].removeCue(e);
            this.cues_.push(e), this.cues.setCues_(this.cues_)
        }, e.prototype.removeCue = function (t) {
            for (var e = this.cues_.length; e--;) {
                var n = this.cues_[e];
                if (n === t || n.originalCue_ && n.originalCue_ === t) {
                    this.cues_.splice(e, 1), this.cues.setCues_(this.cues_);
                    break
                }
            }
        }, e
    }(Gn);
    fr.prototype.allowedEvents_ = {cuechange: "cuechange"};
    var vr = function (t) {
        function e() {
            var n, r, i = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {};
            De(this, e);
            var o = Z(i, {kind: qn[i.kind] || ""}), s = n = Re(this, t.call(this, o)), a = !1;
            if (xe) for (var l in e.prototype) "constructor" !== l && (s[l] = e.prototype[l]);
            return Object.defineProperty(s, "enabled", {
                get: function () {
                    return a
                }, set: function (t) {
                    "boolean" == typeof t && t !== a && (a = t, this.trigger("enabledchange"))
                }
            }), o.enabled && (s.enabled = o.enabled), s.loaded_ = !0, r = s, Re(n, r)
        }

        return Le(e, t), e
    }(Gn), yr = function (t) {
        function e() {
            var n, r, i = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {};
            De(this, e);
            var o = Z(i, {kind: Xn[i.kind] || ""}), s = n = Re(this, t.call(this, o)), a = !1;
            if (xe) for (var l in e.prototype) "constructor" !== l && (s[l] = e.prototype[l]);
            return Object.defineProperty(s, "selected", {
                get: function () {
                    return a
                }, set: function (t) {
                    "boolean" == typeof t && t !== a && (a = t, this.trigger("selectedchange"))
                }
            }), o.selected && (s.selected = o.selected), r = s, Re(n, r)
        }

        return Le(e, t), e
    }(Gn), gr = 0, mr = 2, _r = function (t) {
        function e() {
            var n = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {};
            De(this, e);
            var r = Re(this, t.call(this)), i = void 0, o = r;
            if (xe) {
                o = ue.createElement("custom");
                for (var s in e.prototype) "constructor" !== s && (o[s] = e.prototype[s])
            }
            var a = new fr(n);
            if (o.kind = a.kind, o.src = a.src, o.srclang = a.language, o.label = a.label, o.default = a.default, Object.defineProperty(o, "readyState", {
                get: function () {
                    return i
                }
            }), Object.defineProperty(o, "track", {
                get: function () {
                    return a
                }
            }), i = gr, a.addEventListener("loadeddata", function () {
                i = mr, o.trigger({type: "load", target: o})
            }), xe) {
                var l;
                return l = o, Re(r, l)
            }
            return r
        }

        return Le(e, t), e
    }(hn);
    _r.prototype.allowedEvents_ = {load: "load"}, _r.NONE = gr, _r.LOADING = 1, _r.LOADED = mr, _r.ERROR = 3;
    var br = {
        audio: {ListClass: Fn, TrackClass: vr, capitalName: "Audio"},
        video: {ListClass: Hn, TrackClass: yr, capitalName: "Video"},
        text: {ListClass: Wn, TrackClass: fr, capitalName: "Text"}
    };
    Object.keys(br).forEach(function (t) {
        br[t].getterName = t + "Tracks", br[t].privateName = t + "Tracks_"
    });
    var Tr = {
        remoteText: {
            ListClass: Wn,
            TrackClass: fr,
            capitalName: "RemoteText",
            getterName: "remoteTextTracks",
            privateName: "remoteTextTracks_"
        },
        remoteTextEl: {
            ListClass: Un,
            TrackClass: _r,
            capitalName: "RemoteTextTrackEls",
            getterName: "remoteTextTrackEls",
            privateName: "remoteTextTrackEls_"
        }
    }, Cr = Z(br, Tr);
    Tr.names = Object.keys(Tr), br.names = Object.keys(br), Cr.names = [].concat(Tr.names).concat(br.names);
    var kr = Object.create || function () {
        function t() {
        }

        return function (e) {
            if (1 !== arguments.length) throw new Error("Object.create shim only accepts one parameter.");
            return t.prototype = e, new t
        }
    }();
    _t.prototype = kr(Error.prototype), _t.prototype.constructor = _t, _t.Errors = {
        BadSignature: {
            code: 0,
            message: "Malformed WebVTT signature."
        }, BadTimeStamp: {code: 1, message: "Malformed time stamp."}
    }, Tt.prototype = {
        set: function (t, e) {
            this.get(t) || "" === e || (this.values[t] = e)
        }, get: function (t, e, n) {
            return n ? this.has(t) ? this.values[t] : e[n] : this.has(t) ? this.values[t] : e
        }, has: function (t) {
            return t in this.values
        }, alt: function (t, e, n) {
            for (var r = 0; r < n.length; ++r) if (e === n[r]) {
                this.set(t, e);
                break
            }
        }, integer: function (t, e) {
            /^-?\d+$/.test(e) && this.set(t, parseInt(e, 10))
        }, percent: function (t, e) {
            return !!(e.match(/^([\d]{1,3})(\.[\d]*)?%$/) && (e = parseFloat(e)) >= 0 && e <= 100) && (this.set(t, e), !0)
        }
    };
    var wr = {"&amp;": "&", "&lt;": "<", "&gt;": ">", "&lrm;": "‎", "&rlm;": "‏", "&nbsp;": " "},
        Er = {c: "span", i: "i", b: "b", u: "u", ruby: "ruby", rt: "rt", v: "span", lang: "span"},
        Sr = {v: "title", lang: "lang"}, xr = {rt: "ruby"},
        jr = [[1470, 1470], [1472, 1472], [1475, 1475], [1478, 1478], [1488, 1514], [1520, 1524], [1544, 1544], [1547, 1547], [1549, 1549], [1563, 1563], [1566, 1610], [1645, 1647], [1649, 1749], [1765, 1766], [1774, 1775], [1786, 1805], [1807, 1808], [1810, 1839], [1869, 1957], [1969, 1969], [1984, 2026], [2036, 2037], [2042, 2042], [2048, 2069], [2074, 2074], [2084, 2084], [2088, 2088], [2096, 2110], [2112, 2136], [2142, 2142], [2208, 2208], [2210, 2220], [8207, 8207], [64285, 64285], [64287, 64296], [64298, 64310], [64312, 64316], [64318, 64318], [64320, 64321], [64323, 64324], [64326, 64449], [64467, 64829], [64848, 64911], [64914, 64967], [65008, 65020], [65136, 65140], [65142, 65276], [67584, 67589], [67592, 67592], [67594, 67637], [67639, 67640], [67644, 67644], [67647, 67669], [67671, 67679], [67840, 67867], [67872, 67897], [67903, 67903], [67968, 68023], [68030, 68031], [68096, 68096], [68112, 68115], [68117, 68119], [68121, 68147], [68160, 68167], [68176, 68184], [68192, 68223], [68352, 68405], [68416, 68437], [68440, 68466], [68472, 68479], [68608, 68680], [126464, 126467], [126469, 126495], [126497, 126498], [126500, 126500], [126503, 126503], [126505, 126514], [126516, 126519], [126521, 126521], [126523, 126523], [126530, 126530], [126535, 126535], [126537, 126537], [126539, 126539], [126541, 126543], [126545, 126546], [126548, 126548], [126551, 126551], [126553, 126553], [126555, 126555], [126557, 126557], [126559, 126559], [126561, 126562], [126564, 126564], [126567, 126570], [126572, 126578], [126580, 126583], [126585, 126588], [126590, 126590], [126592, 126601], [126603, 126619], [126625, 126627], [126629, 126633], [126635, 126651], [1114109, 1114109]];
    jt.prototype.applyStyles = function (t, e) {
        e = e || this.div;
        for (var n in t) t.hasOwnProperty(n) && (e.style[n] = t[n])
    }, jt.prototype.formatStyle = function (t, e) {
        return 0 === t ? 0 : t + e
    }, At.prototype = kr(jt.prototype), At.prototype.constructor = At, Pt.prototype.move = function (t, e) {
        switch (e = void 0 !== e ? e : this.lineHeight, t) {
            case"+x":
                this.left += e, this.right += e;
                break;
            case"-x":
                this.left -= e, this.right -= e;
                break;
            case"+y":
                this.top += e, this.bottom += e;
                break;
            case"-y":
                this.top -= e, this.bottom -= e
        }
    }, Pt.prototype.overlaps = function (t) {
        return this.left < t.right && this.right > t.left && this.top < t.bottom && this.bottom > t.top
    }, Pt.prototype.overlapsAny = function (t) {
        for (var e = 0; e < t.length; e++) if (this.overlaps(t[e])) return !0;
        return !1
    }, Pt.prototype.within = function (t) {
        return this.top >= t.top && this.bottom <= t.bottom && this.left >= t.left && this.right <= t.right
    }, Pt.prototype.overlapsOppositeAxis = function (t, e) {
        switch (e) {
            case"+x":
                return this.left < t.left;
            case"-x":
                return this.right > t.right;
            case"+y":
                return this.top < t.top;
            case"-y":
                return this.bottom > t.bottom
        }
    }, Pt.prototype.intersectPercentage = function (t) {
        return Math.max(0, Math.min(this.right, t.right) - Math.max(this.left, t.left)) * Math.max(0, Math.min(this.bottom, t.bottom) - Math.max(this.top, t.top)) / (this.height * this.width)
    }, Pt.prototype.toCSSCompatValues = function (t) {
        return {
            top: this.top - t.top,
            bottom: t.bottom - this.bottom,
            left: this.left - t.left,
            right: t.right - this.right,
            height: this.height,
            width: this.width
        }
    }, Pt.getSimpleBoxPosition = function (t) {
        var e = t.div ? t.div.offsetHeight : t.tagName ? t.offsetHeight : 0,
            n = t.div ? t.div.offsetWidth : t.tagName ? t.offsetWidth : 0,
            r = t.div ? t.div.offsetTop : t.tagName ? t.offsetTop : 0;
        return t = t.div ? t.div.getBoundingClientRect() : t.tagName ? t.getBoundingClientRect() : t, {
            left: t.left,
            right: t.right,
            top: t.top || r,
            height: t.height || e,
            bottom: t.bottom || r + (t.height || e),
            width: t.width || n
        }
    }, Ot.StringDecoder = function () {
        return {
            decode: function (t) {
                if (!t) return "";
                if ("string" != typeof t) throw new Error("Error - expected string data.");
                return decodeURIComponent(encodeURIComponent(t))
            }
        }
    }, Ot.convertCueToDOMTree = function (t, e) {
        return t && e ? wt(t, e) : null
    };
    Ot.processCues = function (t, e, n) {
        if (!t || !e || !n) return null;
        for (; n.firstChild;) n.removeChild(n.firstChild);
        var r = t.document.createElement("div");
        if (r.style.position = "absolute", r.style.left = "0", r.style.right = "0", r.style.top = "0", r.style.bottom = "0", r.style.margin = "1.5%", n.appendChild(r), function (t) {
            for (var e = 0; e < t.length; e++) if (t[e].hasBeenReset || !t[e].displayState) return !0;
            return !1
        }(e)) {
            var i = [], o = Pt.getSimpleBoxPosition(r), s = Math.round(.05 * o.height * 100) / 100,
                a = {font: s + "px sans-serif"};
            !function () {
                for (var n, s, l = 0; l < e.length; l++) s = e[l], n = new At(t, s, a), r.appendChild(n.div), Nt(t, n, o, i), s.displayState = n.div, i.push(Pt.getSimpleBoxPosition(n))
            }()
        } else for (var l = 0; l < e.length; l++) r.appendChild(e[l].displayState)
    }, Ot.Parser = function (t, e, n) {
        n || (n = e, e = {}), e || (e = {}), this.window = t, this.vttjs = e, this.state = "INITIAL", this.buffer = "", this.decoder = n || new TextDecoder("utf8"), this.regionList = []
    }, Ot.Parser.prototype = {
        reportOrThrowError: function (t) {
            if (!(t instanceof _t)) throw t;
            this.onparsingerror && this.onparsingerror(t)
        }, parse: function (t) {
            function e() {
                for (var t = i.buffer, e = 0; e < t.length && "\r" !== t[e] && "\n" !== t[e];) ++e;
                var n = t.substr(0, e);
                return "\r" === t[e] && ++e, "\n" === t[e] && ++e, i.buffer = t.substr(e), n
            }

            function n(t) {
                var e = new Tt;
                if (Ct(t, function (t, n) {
                    switch (t) {
                        case"id":
                            e.set(t, n);
                            break;
                        case"width":
                            e.percent(t, n);
                            break;
                        case"lines":
                            e.integer(t, n);
                            break;
                        case"regionanchor":
                        case"viewportanchor":
                            var r = n.split(",");
                            if (2 !== r.length) break;
                            var i = new Tt;
                            if (i.percent("x", r[0]), i.percent("y", r[1]), !i.has("x") || !i.has("y")) break;
                            e.set(t + "X", i.get("x")), e.set(t + "Y", i.get("y"));
                            break;
                        case"scroll":
                            e.alt(t, n, ["up"])
                    }
                }, /=/, /\s/), e.has("id")) {
                    var n = new (i.vttjs.VTTRegion || i.window.VTTRegion);
                    n.width = e.get("width", 100), n.lines = e.get("lines", 3), n.regionAnchorX = e.get("regionanchorX", 0), n.regionAnchorY = e.get("regionanchorY", 100), n.viewportAnchorX = e.get("viewportanchorX", 0), n.viewportAnchorY = e.get("viewportanchorY", 100), n.scroll = e.get("scroll", ""), i.onregion && i.onregion(n), i.regionList.push({
                        id: e.get("id"),
                        region: n
                    })
                }
            }

            function r(t) {
                var e = new Tt;
                Ct(t, function (t, n) {
                    switch (t) {
                        case"MPEGT":
                            e.integer(t + "S", n);
                            break;
                        case"LOCA":
                            e.set(t + "L", bt(n))
                    }
                }, /[^\d]:/, /,/), i.ontimestampmap && i.ontimestampmap({
                    MPEGTS: e.get("MPEGTS"),
                    LOCAL: e.get("LOCAL")
                })
            }

            var i = this;
            t && (i.buffer += i.decoder.decode(t, {stream: !0}));
            try {
                var o;
                if ("INITIAL" === i.state) {
                    if (!/\r\n|\n/.test(i.buffer)) return this;
                    o = e();
                    var s = o.match(/^WEBVTT([ \t].*)?$/);
                    if (!s || !s[0]) throw new _t(_t.Errors.BadSignature);
                    i.state = "HEADER"
                }
                for (var a = !1; i.buffer;) {
                    if (!/\r\n|\n/.test(i.buffer)) return this;
                    switch (a ? a = !1 : o = e(), i.state) {
                        case"HEADER":
                            /:/.test(o) ? function (t) {
                                t.match(/X-TIMESTAMP-MAP/) ? Ct(t, function (t, e) {
                                    switch (t) {
                                        case"X-TIMESTAMP-MAP":
                                            r(e)
                                    }
                                }, /=/) : Ct(t, function (t, e) {
                                    switch (t) {
                                        case"Region":
                                            n(e)
                                    }
                                }, /:/)
                            }(o) : o || (i.state = "ID");
                            continue;
                        case"NOTE":
                            o || (i.state = "ID");
                            continue;
                        case"ID":
                            if (/^NOTE($|[ \t])/.test(o)) {
                                i.state = "NOTE";
                                break
                            }
                            if (!o) continue;
                            if (i.cue = new (i.vttjs.VTTCue || i.window.VTTCue)(0, 0, ""), i.state = "CUE", -1 === o.indexOf("--\x3e")) {
                                i.cue.id = o;
                                continue
                            }
                        case"CUE":
                            try {
                                kt(o, i.cue, i.regionList)
                            } catch (t) {
                                i.reportOrThrowError(t), i.cue = null, i.state = "BADCUE";
                                continue
                            }
                            i.state = "CUETEXT";
                            continue;
                        case"CUETEXT":
                            var l = -1 !== o.indexOf("--\x3e");
                            if (!o || l && (a = !0)) {
                                i.oncue && i.oncue(i.cue), i.cue = null, i.state = "ID";
                                continue
                            }
                            i.cue.text && (i.cue.text += "\n"), i.cue.text += o;
                            continue;
                        case"BADCUE":
                            o || (i.state = "ID");
                            continue
                    }
                }
            } catch (t) {
                i.reportOrThrowError(t), "CUETEXT" === i.state && i.cue && i.oncue && i.oncue(i.cue), i.cue = null, i.state = "INITIAL" === i.state ? "BADWEBVTT" : "BADCUE"
            }
            return this
        }, flush: function () {
            var t = this;
            try {
                if (t.buffer += t.decoder.decode(), (t.cue || "HEADER" === t.state) && (t.buffer += "\n\n", t.parse()), "INITIAL" === t.state) throw new _t(_t.Errors.BadSignature)
            } catch (e) {
                t.reportOrThrowError(e)
            }
            return t.onflush && t.onflush(), this
        }
    };
    var Ar = Ot, Pr = "auto", Nr = {"": !0, lr: !0, rl: !0}, Or = {start: !0, middle: !0, end: !0, left: !0, right: !0};
    Lt.prototype.getCueAsHTML = function () {
        return WebVTT.convertCueToDOMTree(window, this.text)
    };
    var Mr = Lt, Ir = {"": !0, up: !0}, Dr = Ft, Lr = t(function (t) {
        var e = t.exports = {WebVTT: Ar, VTTCue: Mr, VTTRegion: Dr};
        oe.vttjs = e, oe.WebVTT = e.WebVTT;
        var n = e.VTTCue, r = e.VTTRegion, i = oe.VTTCue, o = oe.VTTRegion;
        e.shim = function () {
            oe.VTTCue = n, oe.VTTRegion = r
        }, e.restore = function () {
            oe.VTTCue = i, oe.VTTRegion = o
        }, oe.VTTCue || e.shim()
    }), Rr = function (t) {
        function e() {
            var n = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {},
                r = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : function () {
                };
            De(this, e), n.reportTouchActivity = !1;
            var i = Re(this, t.call(this, null, n, r));
            return i.hasStarted_ = !1, i.on("playing", function () {
                this.hasStarted_ = !0
            }), i.on("loadstart", function () {
                this.hasStarted_ = !1
            }), Cr.names.forEach(function (t) {
                var e = Cr[t];
                n && n[e.getterName] && (i[e.privateName] = n[e.getterName])
            }), i.featuresProgressEvents || i.manualProgressOn(), i.featuresTimeupdateEvents || i.manualTimeUpdatesOn(), ["Text", "Audio", "Video"].forEach(function (t) {
                !1 === n["native" + t + "Tracks"] && (i["featuresNative" + t + "Tracks"] = !1)
            }), !1 === n.nativeCaptions || !1 === n.nativeTextTracks ? i.featuresNativeTextTracks = !1 : !0 !== n.nativeCaptions && !0 !== n.nativeTextTracks || (i.featuresNativeTextTracks = !0), i.featuresNativeTextTracks || i.emulateTextTracks(), i.autoRemoteTextTracks_ = new Cr.text.ListClass, i.initTrackListeners(), n.nativeControlsForTouch || i.emitTapEvents(), i.constructor && (i.name_ = i.constructor.name || "Unknown Tech"), i
        }

        return Le(e, t), e.prototype.manualProgressOn = function () {
            this.on("durationchange", this.onDurationChange), this.manualProgress = !0, this.one("ready", this.trackProgress)
        }, e.prototype.manualProgressOff = function () {
            this.manualProgress = !1, this.stopTrackingProgress(), this.off("durationchange", this.onDurationChange)
        }, e.prototype.trackProgress = function (t) {
            this.stopTrackingProgress(), this.progressInterval = this.setInterval(cn(this, function () {
                var t = this.bufferedPercent();
                this.bufferedPercent_ !== t && this.trigger("progress"), this.bufferedPercent_ = t, 1 === t && this.stopTrackingProgress()
            }), 500)
        }, e.prototype.onDurationChange = function (t) {
            this.duration_ = this.duration()
        }, e.prototype.buffered = function () {
            return rt(0, 0)
        }, e.prototype.bufferedPercent = function () {
            return it(this.buffered(), this.duration_)
        }, e.prototype.stopTrackingProgress = function () {
            this.clearInterval(this.progressInterval)
        }, e.prototype.manualTimeUpdatesOn = function () {
            this.manualTimeUpdates = !0, this.on("play", this.trackCurrentTime), this.on("pause", this.stopTrackingCurrentTime)
        }, e.prototype.manualTimeUpdatesOff = function () {
            this.manualTimeUpdates = !1, this.stopTrackingCurrentTime(), this.off("play", this.trackCurrentTime), this.off("pause", this.stopTrackingCurrentTime)
        }, e.prototype.trackCurrentTime = function () {
            this.currentTimeInterval && this.stopTrackingCurrentTime(), this.currentTimeInterval = this.setInterval(function () {
                this.trigger({type: "timeupdate", target: this, manuallyTriggered: !0})
            }, 250)
        }, e.prototype.stopTrackingCurrentTime = function () {
            this.clearInterval(this.currentTimeInterval), this.trigger({
                type: "timeupdate",
                target: this,
                manuallyTriggered: !0
            })
        }, e.prototype.dispose = function () {
            this.clearTracks(br.names), this.manualProgress && this.manualProgressOff(), this.manualTimeUpdates && this.manualTimeUpdatesOff(), t.prototype.dispose.call(this)
        }, e.prototype.clearTracks = function (t) {
            var e = this;
            t = [].concat(t), t.forEach(function (t) {
                for (var n = e[t + "Tracks"]() || [], r = n.length; r--;) {
                    var i = n[r];
                    "text" === t && e.removeRemoteTextTrack(i), n.removeTrack(i)
                }
            })
        }, e.prototype.cleanupAutoTextTracks = function () {
            for (var t = this.autoRemoteTextTracks_ || [], e = t.length; e--;) {
                var n = t[e];
                this.removeRemoteTextTrack(n)
            }
        }, e.prototype.reset = function () {
        }, e.prototype.error = function (t) {
            return void 0 !== t && (this.error_ = new ot(t), this.trigger("error")), this.error_
        }, e.prototype.played = function () {
            return this.hasStarted_ ? rt(0, 0) : rt()
        }, e.prototype.setCurrentTime = function () {
            this.manualTimeUpdates && this.trigger({type: "timeupdate", target: this, manuallyTriggered: !0})
        }, e.prototype.initTrackListeners = function () {
            var t = this;
            br.names.forEach(function (e) {
                var n = br[e], r = function () {
                    t.trigger(e + "trackchange")
                }, i = t[n.getterName]();
                i.addEventListener("removetrack", r), i.addEventListener("addtrack", r), t.on("dispose", function () {
                    i.removeEventListener("removetrack", r), i.removeEventListener("addtrack", r)
                })
            })
        }, e.prototype.addWebVttScript_ = function () {
            var t = this;
            if (!oe.WebVTT) if (ue.body.contains(this.el())) {
                if (!this.options_["vtt.js"] && o(Lr) && Object.keys(Lr).length > 0) return void this.trigger("vttjsloaded");
                var e = ue.createElement("script");
                e.src = this.options_["vtt.js"] || "https://vjs.zencdn.net/vttjs/0.12.4/vtt.min.js", e.onload = function () {
                    t.trigger("vttjsloaded")
                }, e.onerror = function () {
                    t.trigger("vttjserror")
                }, this.on("dispose", function () {
                    e.onload = null, e.onerror = null
                }), oe.WebVTT = !0, this.el().parentNode.appendChild(e)
            } else this.ready(this.addWebVttScript_)
        }, e.prototype.emulateTextTracks = function () {
            var t = this, e = this.textTracks(), n = this.remoteTextTracks(), r = function (t) {
                return e.addTrack(t.track)
            }, i = function (t) {
                return e.removeTrack(t.track)
            };
            n.on("addtrack", r), n.on("removetrack", i), this.addWebVttScript_();
            var o = function () {
                return t.trigger("texttrackchange")
            }, s = function () {
                o();
                for (var t = 0; t < e.length; t++) {
                    var n = e[t];
                    n.removeEventListener("cuechange", o), "showing" === n.mode && n.addEventListener("cuechange", o)
                }
            };
            s(), e.addEventListener("change", s), e.addEventListener("addtrack", s), e.addEventListener("removetrack", s), this.on("dispose", function () {
                n.off("addtrack", r), n.off("removetrack", i), e.removeEventListener("change", s), e.removeEventListener("addtrack", s), e.removeEventListener("removetrack", s);
                for (var t = 0; t < e.length; t++) {
                    e[t].removeEventListener("cuechange", o)
                }
            })
        }, e.prototype.addTextTrack = function (t, e, n) {
            if (!t) throw new Error("TextTrack kind is required but was not provided");
            return Vt(this, t, e, n)
        }, e.prototype.createRemoteTextTrack = function (t) {
            var e = Z(t, {tech: this});
            return new Tr.remoteTextEl.TrackClass(e)
        }, e.prototype.addRemoteTextTrack = function () {
            var t = this, e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {}, n = arguments[1],
                r = this.createRemoteTextTrack(e);
            return !0 !== n && !1 !== n && (Xe.warn('Calling addRemoteTextTrack without explicitly setting the "manualCleanup" parameter to `true` is deprecated and default to `false` in future version of video.js'), n = !0), this.remoteTextTrackEls().addTrackElement_(r), this.remoteTextTracks().addTrack(r.track), !0 !== n && this.ready(function () {
                return t.autoRemoteTextTracks_.addTrack(r.track)
            }), r
        }, e.prototype.removeRemoteTextTrack = function (t) {
            var e = this.remoteTextTrackEls().getTrackElementByTrack_(t);
            this.remoteTextTrackEls().removeTrackElement_(e), this.remoteTextTracks().removeTrack(t), this.autoRemoteTextTracks_.removeTrack(t)
        }, e.prototype.getVideoPlaybackQuality = function () {
            return {}
        }, e.prototype.setPoster = function () {
        }, e.prototype.playsinline = function () {
        }, e.prototype.setPlaysinline = function () {
        }, e.prototype.canPlayType = function () {
            return ""
        }, e.canPlayType = function () {
            return ""
        }, e.canPlaySource = function (t, n) {
            return e.canPlayType(t.type)
        }, e.isTech = function (t) {
            return t.prototype instanceof e || t instanceof e || t === e
        }, e.registerTech = function (t, n) {
            if (e.techs_ || (e.techs_ = {}), !e.isTech(n)) throw new Error("Tech " + t + " must be a Tech");
            if (!e.canPlayType) throw new Error("Techs must have a static canPlayType method on them");
            if (!e.canPlaySource) throw new Error("Techs must have a static canPlaySource method on them");
            return t = J(t), e.techs_[t] = n, "Tech" !== t && e.defaultTechOrder_.push(t), n
        }, e.getTech = function (t) {
            if (t) return t = J(t), e.techs_ && e.techs_[t] ? e.techs_[t] : oe && oe.videojs && oe.videojs[t] ? (Xe.warn("The " + t + " tech was added to the videojs object when it should be registered using videojs.registerTech(name, tech)"), oe.videojs[t]) : void 0
        }, e
    }(Tn);
    Cr.names.forEach(function (t) {
        var e = Cr[t];
        Rr.prototype[e.getterName] = function () {
            return this[e.privateName] = this[e.privateName] || new e.ListClass, this[e.privateName]
        }
    }), Rr.prototype.featuresVolumeControl = !0, Rr.prototype.featuresFullscreenResize = !1, Rr.prototype.featuresPlaybackRate = !1, Rr.prototype.featuresProgressEvents = !1, Rr.prototype.featuresTimeupdateEvents = !1, Rr.prototype.featuresNativeTextTracks = !1, Rr.withSourceHandlers = function (t) {
        t.registerSourceHandler = function (e, n) {
            var r = t.sourceHandlers;
            r || (r = t.sourceHandlers = []), void 0 === n && (n = r.length), r.splice(n, 0, e)
        }, t.canPlayType = function (e) {
            for (var n = t.sourceHandlers || [], r = void 0, i = 0; i < n.length; i++) if (r = n[i].canPlayType(e)) return r;
            return ""
        }, t.selectSourceHandler = function (e, n) {
            for (var r = t.sourceHandlers || [], i = 0; i < r.length; i++) if (r[i].canHandleSource(e, n)) return r[i];
            return null
        }, t.canPlaySource = function (e, n) {
            var r = t.selectSourceHandler(e, n);
            return r ? r.canHandleSource(e, n) : ""
        }, ["seekable", "duration"].forEach(function (t) {
            var e = this[t];
            "function" == typeof e && (this[t] = function () {
                return this.sourceHandler_ && this.sourceHandler_[t] ? this.sourceHandler_[t].apply(this.sourceHandler_, arguments) : e.apply(this, arguments)
            })
        }, t.prototype), t.prototype.setSource = function (e) {
            var n = t.selectSourceHandler(e, this.options_);
            n || (t.nativeSourceHandler ? n = t.nativeSourceHandler : Xe.error("No source hander found for the current source.")), this.disposeSourceHandler(), this.off("dispose", this.disposeSourceHandler), n !== t.nativeSourceHandler && (this.currentSource_ = e), this.sourceHandler_ = n.handleSource(e, this, this.options_), this.on("dispose", this.disposeSourceHandler)
        }, t.prototype.disposeSourceHandler = function () {
            this.currentSource_ && (this.clearTracks(["audio", "video"]), this.currentSource_ = null), this.cleanupAutoTextTracks(), this.sourceHandler_ && (this.sourceHandler_.dispose && this.sourceHandler_.dispose(), this.sourceHandler_ = null)
        }
    }, Tn.registerComponent("Tech", Rr), Rr.registerTech("Tech", Rr), Rr.defaultTechOrder_ = [];
    var Br = {}, Fr = {buffered: 1, currentTime: 1, duration: 1, seekable: 1, played: 1}, Vr = {setCurrentTime: 1},
        Hr = function t(e) {
            if (Array.isArray(e)) {
                var n = [];
                e.forEach(function (e) {
                    e = t(e), Array.isArray(e) ? n = n.concat(e) : i(e) && n.push(e)
                }), e = n
            } else e = "string" == typeof e && e.trim() ? [{src: e}] : i(e) && "string" == typeof e.src && e.src && e.src.trim() ? [e] : [];
            return e
        }, Wr = function (t) {
            function e(n, r, i) {
                De(this, e);
                var o = Z({createEl: !1}, r), s = Re(this, t.call(this, n, o, i));
                if (r.playerOptions.sources && 0 !== r.playerOptions.sources.length) n.src(r.playerOptions.sources); else for (var a = 0, l = r.playerOptions.techOrder; a < l.length; a++) {
                    var c = J(l[a]), u = Rr.getTech(c);
                    if (c || (u = Tn.getComponent(c)), u && u.isSupported()) {
                        n.loadTech_(c);
                        break
                    }
                }
                return s
            }

            return Le(e, t), e
        }(Tn);
    Tn.registerComponent("MediaLoader", Wr);
    var Ur = function (t) {
        function e(n, r) {
            De(this, e);
            var i = Re(this, t.call(this, n, r));
            return i.emitTapEvents(), i.enable(), i
        }

        return Le(e, t), e.prototype.createEl = function () {
            var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : "div",
                n = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {},
                i = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : {};
            n = r({
                innerHTML: '<span aria-hidden="true" class="vjs-icon-placeholder"></span>',
                className: this.buildCSSClass(),
                tabIndex: 0
            }, n), "button" === e && Xe.error("Creating a ClickableComponent with an HTML element of " + e + " is not supported; use a Button instead."), i = r({
                role: "button",
                "aria-live": "polite"
            }, i), this.tabIndex_ = n.tabIndex;
            var o = t.prototype.createEl.call(this, e, n, i);
            return this.createControlTextEl(o), o
        }, e.prototype.createControlTextEl = function (t) {
            return this.controlTextEl_ = v("span", {className: "vjs-control-text"}), t && t.appendChild(this.controlTextEl_), this.controlText(this.controlText_, t), this.controlTextEl_
        }, e.prototype.controlText = function (t) {
            var e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : this.el();
            if (!t) return this.controlText_ || "Need Text";
            var n = this.localize(t);
            this.controlText_ = t, y(this.controlTextEl_, n), this.nonIconControl || e.setAttribute("title", n)
        }, e.prototype.buildCSSClass = function () {
            return "vjs-control vjs-button " + t.prototype.buildCSSClass.call(this)
        }, e.prototype.enable = function () {
            this.enabled_ || (this.enabled_ = !0, this.removeClass("vjs-disabled"), this.el_.setAttribute("aria-disabled", "false"), void 0 !== this.tabIndex_ && this.el_.setAttribute("tabIndex", this.tabIndex_), this.on(["tap", "click"], this.handleClick), this.on("focus", this.handleFocus), this.on("blur", this.handleBlur))
        }, e.prototype.disable = function () {
            this.enabled_ = !1, this.addClass("vjs-disabled"), this.el_.setAttribute("aria-disabled", "true"), void 0 !== this.tabIndex_ && this.el_.removeAttribute("tabIndex"), this.off(["tap", "click"], this.handleClick), this.off("focus", this.handleFocus), this.off("blur", this.handleBlur)
        }, e.prototype.handleClick = function (t) {
        }, e.prototype.handleFocus = function (t) {
            z(ue, "keydown", cn(this, this.handleKeyPress))
        }, e.prototype.handleKeyPress = function (e) {
            32 === e.which || 13 === e.which ? (e.preventDefault(), this.trigger("click")) : t.prototype.handleKeyPress && t.prototype.handleKeyPress.call(this, e)
        }, e.prototype.handleBlur = function (t) {
            X(ue, "keydown", cn(this, this.handleKeyPress))
        }, e
    }(Tn);
    Tn.registerComponent("ClickableComponent", Ur);
    var zr = function (t) {
        function e(n, r) {
            De(this, e);
            var i = Re(this, t.call(this, n, r));
            return i.update(), n.on("posterchange", cn(i, i.update)), i
        }

        return Le(e, t), e.prototype.dispose = function () {
            this.player().off("posterchange", this.update), t.prototype.dispose.call(this)
        }, e.prototype.createEl = function () {
            var t = v("div", {className: "vjs-poster", tabIndex: -1});
            return Oe || (this.fallbackImg_ = v("img"), t.appendChild(this.fallbackImg_)), t
        }, e.prototype.update = function (t) {
            var e = this.player().poster();
            this.setSrc(e), e ? this.show() : this.hide()
        }, e.prototype.setSrc = function (t) {
            if (this.fallbackImg_) this.fallbackImg_.src = t; else {
                var e = "";
                t && (e = 'url("' + t + '")'), this.el_.style.backgroundImage = e
            }
        }, e.prototype.handleClick = function (t) {
            this.player_.controls() && (this.player_.paused() ? this.player_.play() : this.player_.pause())
        }, e
    }(Ur);
    Tn.registerComponent("PosterImage", zr);
    var Xr = {
        monospace: "monospace",
        sansSerif: "sans-serif",
        serif: "serif",
        monospaceSansSerif: '"Andale Mono", "Lucida Console", monospace',
        monospaceSerif: '"Courier New", monospace',
        proportionalSansSerif: "sans-serif",
        proportionalSerif: "serif",
        casual: '"Comic Sans MS", Impact, fantasy',
        script: '"Monotype Corsiva", cursive',
        smallcaps: '"Andale Mono", "Lucida Console", monospace, sans-serif'
    }, qr = function (t) {
        function e(n, r, i) {
            De(this, e);
            var o = Re(this, t.call(this, n, r, i));
            return n.on("loadstart", cn(o, o.toggleDisplay)), n.on("texttrackchange", cn(o, o.updateDisplay)), n.on("loadstart", cn(o, o.preselectTrack)), n.ready(cn(o, function () {
                if (n.tech_ && n.tech_.featuresNativeTextTracks) return void this.hide();
                n.on("fullscreenchange", cn(this, this.updateDisplay));
                for (var t = this.options_.playerOptions.tracks || [], e = 0; e < t.length; e++) this.player_.addRemoteTextTrack(t[e], !0);
                this.preselectTrack()
            })), o
        }

        return Le(e, t), e.prototype.preselectTrack = function () {
            for (var t = {
                captions: 1,
                subtitles: 1
            }, e = this.player_.textTracks(), n = this.player_.cache_.selectedLanguage, r = void 0, i = void 0, o = void 0, s = 0; s < e.length; s++) {
                var a = e[s];
                n && n.enabled && n.language === a.language ? a.kind === n.kind ? o = a : o || (o = a) : n && !n.enabled ? (o = null, r = null, i = null) : a.default && ("descriptions" !== a.kind || r ? a.kind in t && !i && (i = a) : r = a)
            }
            o ? o.mode = "showing" : i ? i.mode = "showing" : r && (r.mode = "showing")
        }, e.prototype.toggleDisplay = function () {
            this.player_.tech_ && this.player_.tech_.featuresNativeTextTracks ? this.hide() : this.show()
        }, e.prototype.createEl = function () {
            return t.prototype.createEl.call(this, "div", {className: "vjs-text-track-display"}, {
                "aria-live": "off",
                "aria-atomic": "true"
            })
        }, e.prototype.clearDisplay = function () {
            "function" == typeof oe.WebVTT && oe.WebVTT.processCues(oe, [], this.el_)
        }, e.prototype.updateDisplay = function () {
            var t = this.player_.textTracks();
            this.clearDisplay();
            for (var e = null, n = null, r = t.length; r--;) {
                var i = t[r];
                "showing" === i.mode && ("descriptions" === i.kind ? e = i : n = i)
            }
            n ? ("off" !== this.getAttribute("aria-live") && this.setAttribute("aria-live", "off"), this.updateForTrack(n)) : e && ("assertive" !== this.getAttribute("aria-live") && this.setAttribute("aria-live", "assertive"), this.updateForTrack(e))
        }, e.prototype.updateForTrack = function (t) {
            if ("function" == typeof oe.WebVTT && t.activeCues) {
                for (var e = this.player_.textTrackSettings.getValues(), n = [], r = 0; r < t.activeCues.length; r++) n.push(t.activeCues[r]);
                oe.WebVTT.processCues(oe, n, this.el_);
                for (var i = n.length; i--;) {
                    var o = n[i];
                    if (o) {
                        var s = o.displayState;
                        if (e.color && (s.firstChild.style.color = e.color), e.textOpacity && Gt(s.firstChild, "color", Yt(e.color || "#fff", e.textOpacity)), e.backgroundColor && (s.firstChild.style.backgroundColor = e.backgroundColor), e.backgroundOpacity && Gt(s.firstChild, "backgroundColor", Yt(e.backgroundColor || "#000", e.backgroundOpacity)), e.windowColor && (e.windowOpacity ? Gt(s, "backgroundColor", Yt(e.windowColor, e.windowOpacity)) : s.style.backgroundColor = e.windowColor), e.edgeStyle && ("dropshadow" === e.edgeStyle ? s.firstChild.style.textShadow = "2px 2px 3px #222, 2px 2px 4px #222, 2px 2px 5px #222" : "raised" === e.edgeStyle ? s.firstChild.style.textShadow = "1px 1px #222, 2px 2px #222, 3px 3px #222" : "depressed" === e.edgeStyle ? s.firstChild.style.textShadow = "1px 1px #ccc, 0 1px #ccc, -1px -1px #222, 0 -1px #222" : "uniform" === e.edgeStyle && (s.firstChild.style.textShadow = "0 0 4px #222, 0 0 4px #222, 0 0 4px #222, 0 0 4px #222")), e.fontPercent && 1 !== e.fontPercent) {
                            var a = oe.parseFloat(s.style.fontSize);
                            s.style.fontSize = a * e.fontPercent + "px", s.style.height = "auto", s.style.top = "auto", s.style.bottom = "2px"
                        }
                        e.fontFamily && "default" !== e.fontFamily && ("small-caps" === e.fontFamily ? s.firstChild.style.fontVariant = "small-caps" : s.firstChild.style.fontFamily = Xr[e.fontFamily])
                    }
                }
            }
        }, e
    }(Tn);
    Tn.registerComponent("TextTrackDisplay", qr);
    var Kr = function (t) {
        function e() {
            return De(this, e), Re(this, t.apply(this, arguments))
        }

        return Le(e, t), e.prototype.createEl = function () {
            return t.prototype.createEl.call(this, "div", {className: "vjs-loading-spinner", dir: "ltr"})
        }, e
    }(Tn);
    Tn.registerComponent("LoadingSpinner", Kr);
    var Yr = function (t) {
        function e() {
            return De(this, e), Re(this, t.apply(this, arguments))
        }

        return Le(e, t), e.prototype.createEl = function (t) {
            var e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {},
                n = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : {};
            t = "button", e = r({
                innerHTML: '<span aria-hidden="true" class="vjs-icon-placeholder"></span>',
                className: this.buildCSSClass()
            }, e), n = r({type: "button", "aria-live": "polite"}, n);
            var i = Tn.prototype.createEl.call(this, t, e, n);
            return this.createControlTextEl(i), i
        }, e.prototype.addChild = function (t) {
            var e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {}, n = this.constructor.name;
            return Xe.warn("Adding an actionable (user controllable) child to a Button (" + n + ") is not supported; use a ClickableComponent instead."), Tn.prototype.addChild.call(this, t, e)
        }, e.prototype.enable = function () {
            t.prototype.enable.call(this), this.el_.removeAttribute("disabled")
        }, e.prototype.disable = function () {
            t.prototype.disable.call(this), this.el_.setAttribute("disabled", "disabled")
        }, e.prototype.handleKeyPress = function (e) {
            32 !== e.which && 13 !== e.which && t.prototype.handleKeyPress.call(this, e)
        }, e
    }(Ur);
    Tn.registerComponent("Button", Yr);
    var Gr = function (t) {
        function e(n, r) {
            De(this, e);
            var i = Re(this, t.call(this, n, r));
            return i.mouseused_ = !1, i.on("mousedown", i.handleMouseDown), i
        }

        return Le(e, t), e.prototype.buildCSSClass = function () {
            return "vjs-big-play-button"
        }, e.prototype.handleClick = function (t) {
            var e = this.player_.play();
            if (!(this.mouseused_ && t.clientX && t.clientY)) {
                var n = this.player_.getChild("controlBar"), r = n && n.getChild("playToggle");
                if (!r) return void this.player_.focus();
                var i = function () {
                    return r.focus()
                };
                if (e && e.then) {
                    var o = function () {
                    };
                    e.then(i, o)
                } else this.setTimeout(i, 1)
            }
        }, e.prototype.handleKeyPress = function (e) {
            this.mouseused_ = !1, t.prototype.handleKeyPress.call(this, e)
        }, e.prototype.handleMouseDown = function (t) {
            this.mouseused_ = !0
        }, e
    }(Yr);
    Gr.prototype.controlText_ = "Play Video", Tn.registerComponent("BigPlayButton", Gr);
    var $r = function (t) {
        function e(n, r) {
            De(this, e);
            var i = Re(this, t.call(this, n, r));
            return i.controlText(r && r.controlText || i.localize("Close")), i
        }

        return Le(e, t), e.prototype.buildCSSClass = function () {
            return "vjs-close-button " + t.prototype.buildCSSClass.call(this)
        }, e.prototype.handleClick = function (t) {
            this.trigger({type: "close", bubbles: !1})
        }, e
    }(Yr);
    Tn.registerComponent("CloseButton", $r);
    var Jr = function (t) {
        function e(n, r) {
            De(this, e);
            var i = Re(this, t.call(this, n, r));
            return i.on(n, "play", i.handlePlay), i.on(n, "pause", i.handlePause), i.on(n, "ended", i.handleEnded), i
        }

        return Le(e, t), e.prototype.buildCSSClass = function () {
            return "vjs-play-control " + t.prototype.buildCSSClass.call(this)
        }, e.prototype.handleClick = function (t) {
            this.player_.paused() ? this.player_.play() : this.player_.pause()
        }, e.prototype.handleSeeked = function (t) {
            this.removeClass("vjs-ended"), this.player_.paused() ? this.handlePause(t) : this.handlePlay(t)
        }, e.prototype.handlePlay = function (t) {
            this.removeClass("vjs-paused"), this.addClass("vjs-playing"), this.controlText("Pause")
        }, e.prototype.handlePause = function (t) {
            this.removeClass("vjs-playing"), this.addClass("vjs-paused"), this.controlText("Play")
        }, e.prototype.handleEnded = function (t) {
            this.removeClass("vjs-playing"), this.addClass("vjs-ended"), this.controlText("Replay"), this.one(this.player_, "seeked", this.handleSeeked)
        }, e
    }(Yr);
    Jr.prototype.controlText_ = "Play", Tn.registerComponent("PlayToggle", Jr);
    var Qr = function (t) {
        function e(n, r) {
            De(this, e);
            var i = Re(this, t.call(this, n, r));
            return i.throttledUpdateContent = un(cn(i, i.updateContent), 25), i.on(n, "timeupdate", i.throttledUpdateContent), i
        }

        return Le(e, t), e.prototype.createEl = function (e) {
            var n = this.buildCSSClass(),
                r = t.prototype.createEl.call(this, "div", {className: n + " vjs-time-control vjs-control"});
            return this.contentEl_ = v("div", {className: n + "-display"}, {"aria-live": "off"}, v("span", {
                className: "vjs-control-text",
                textContent: this.localize(this.contentText_)
            })), this.updateTextNode_(), r.appendChild(this.contentEl_), r
        }, e.prototype.updateTextNode_ = function () {
            this.textNode_ && this.contentEl_.removeChild(this.textNode_), this.textNode_ = ue.createTextNode(this.formattedTime_ || "0:00"), this.contentEl_.appendChild(this.textNode_)
        }, e.prototype.formatTime_ = function (t) {
            return $t(t)
        }, e.prototype.updateFormattedTime_ = function (t) {
            var e = this.formatTime_(t);
            e !== this.formattedTime_ && (this.formattedTime_ = e, this.requestAnimationFrame(this.updateTextNode_))
        }, e.prototype.updateContent = function (t) {
        }, e
    }(Tn);
    Qr.prototype.controlText_ = "Time", Tn.registerComponent("TimeDisplay", Qr);
    var Zr = function (t) {
        function e(n, r) {
            De(this, e);
            var i = Re(this, t.call(this, n, r));
            return i.on(n, "ended", i.handleEnded), i
        }

        return Le(e, t), e.prototype.buildCSSClass = function () {
            return "vjs-current-time"
        }, e.prototype.updateContent = function (t) {
            var e = this.player_.scrubbing() ? this.player_.getCache().currentTime : this.player_.currentTime();
            this.updateFormattedTime_(e)
        }, e.prototype.handleEnded = function (t) {
            this.player_.duration() && this.updateFormattedTime_(this.player_.duration())
        }, e
    }(Qr);
    Zr.prototype.controlText_ = "Current Time", Tn.registerComponent("CurrentTimeDisplay", Zr);
    var ti = function (t) {
        function e(n, r) {
            De(this, e);
            var i = Re(this, t.call(this, n, r));
            return i.on(n, ["durationchange", "loadedmetadata"], i.throttledUpdateContent), i
        }

        return Le(e, t), e.prototype.buildCSSClass = function () {
            return "vjs-duration"
        }, e.prototype.updateContent = function (t) {
            var e = this.player_.duration();
            e && this.duration_ !== e && (this.duration_ = e, this.updateFormattedTime_(e))
        }, e
    }(Qr);
    ti.prototype.controlText_ = "Duration Time", Tn.registerComponent("DurationDisplay", ti);
    var ei = function (t) {
        function e() {
            return De(this, e), Re(this, t.apply(this, arguments))
        }

        return Le(e, t), e.prototype.createEl = function () {
            return t.prototype.createEl.call(this, "div", {
                className: "vjs-time-control vjs-time-divider",
                innerHTML: "<div><span>/</span></div>"
            })
        }, e
    }(Tn);
    Tn.registerComponent("TimeDivider", ei);
    var ni = function (t) {
        function e(n, r) {
            De(this, e);
            var i = Re(this, t.call(this, n, r));
            return i.on(n, "durationchange", i.throttledUpdateContent), i.on(n, "ended", i.handleEnded), i
        }

        return Le(e, t), e.prototype.buildCSSClass = function () {
            return "vjs-remaining-time"
        }, e.prototype.formatTime_ = function (e) {
            return "-" + t.prototype.formatTime_.call(this, e)
        }, e.prototype.updateContent = function (t) {
            this.player_.duration() && (this.player_.remainingTimeDisplay ? this.updateFormattedTime_(this.player_.remainingTimeDisplay()) : this.updateFormattedTime_(this.player_.remainingTime()))
        }, e.prototype.handleEnded = function (t) {
            this.player_.duration() && this.updateFormattedTime_(0)
        }, e
    }(Qr);
    ni.prototype.controlText_ = "Remaining Time", Tn.registerComponent("RemainingTimeDisplay", ni);
    var ri = function (t) {
        function e(n, r) {
            De(this, e);
            var i = Re(this, t.call(this, n, r));
            return i.updateShowing(), i.on(i.player(), "durationchange", i.updateShowing), i
        }

        return Le(e, t), e.prototype.createEl = function () {
            var e = t.prototype.createEl.call(this, "div", {className: "vjs-live-control vjs-control"});
            return this.contentEl_ = v("div", {
                className: "vjs-live-display",
                innerHTML: '<span class="vjs-control-text">' + this.localize("Stream Type") + "</span>" + this.localize("LIVE")
            }, {"aria-live": "off"}), e.appendChild(this.contentEl_), e
        }, e.prototype.updateShowing = function (t) {
            this.player().duration() === 1 / 0 ? this.show() : this.hide()
        }, e
    }(Tn);
    Tn.registerComponent("LiveDisplay", ri);
    var ii = function (t) {
        function e(n, r) {
            De(this, e);
            var i = Re(this, t.call(this, n, r));
            return i.bar = i.getChild(i.options_.barName), i.vertical(!!i.options_.vertical), i.on("mousedown", i.handleMouseDown), i.on("touchstart", i.handleMouseDown), i.on("focus", i.handleFocus), i.on("blur", i.handleBlur), i.on("click", i.handleClick), i.on(n, "controlsvisible", i.update), i.playerEvent && i.on(n, i.playerEvent, i.update), i
        }

        return Le(e, t), e.prototype.createEl = function (e) {
            var n = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {},
                i = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : {};
            return n.className = n.className + " vjs-slider", n = r({tabIndex: 0}, n), i = r({
                role: "slider",
                "aria-valuenow": 0,
                "aria-valuemin": 0,
                "aria-valuemax": 100,
                tabIndex: 0
            }, i), t.prototype.createEl.call(this, e, n, i)
        }, e.prototype.handleMouseDown = function (t) {
            var e = this.bar.el_.ownerDocument;
            t.preventDefault(), x(), this.addClass("vjs-sliding"), this.trigger("slideractive"), this.on(e, "mousemove", this.handleMouseMove), this.on(e, "mouseup", this.handleMouseUp), this.on(e, "touchmove", this.handleMouseMove), this.on(e, "touchend", this.handleMouseUp), this.handleMouseMove(t)
        }, e.prototype.handleMouseMove = function (t) {
        }, e.prototype.handleMouseUp = function () {
            var t = this.bar.el_.ownerDocument;
            j(), this.removeClass("vjs-sliding"), this.trigger("sliderinactive"), this.off(t, "mousemove", this.handleMouseMove), this.off(t, "mouseup", this.handleMouseUp), this.off(t, "touchmove", this.handleMouseMove), this.off(t, "touchend", this.handleMouseUp), this.update()
        }, e.prototype.update = function () {
            if (this.el_) {
                var t = this.getPercent(), e = this.bar;
                if (e) {
                    ("number" != typeof t || t !== t || t < 0 || t === 1 / 0) && (t = 0);
                    var n = (100 * t).toFixed(2) + "%", r = e.el().style;
                    return this.vertical() ? r.height = n : r.width = n, t
                }
            }
        }, e.prototype.calculateDistance = function (t) {
            var e = N(this.el_, t);
            return this.vertical() ? e.y : e.x
        }, e.prototype.handleFocus = function () {
            this.on(this.bar.el_.ownerDocument, "keydown", this.handleKeyPress)
        }, e.prototype.handleKeyPress = function (t) {
            37 === t.which || 40 === t.which ? (t.preventDefault(), this.stepBack()) : 38 !== t.which && 39 !== t.which || (t.preventDefault(), this.stepForward())
        }, e.prototype.handleBlur = function () {
            this.off(this.bar.el_.ownerDocument, "keydown", this.handleKeyPress)
        }, e.prototype.handleClick = function (t) {
            t.stopImmediatePropagation(), t.preventDefault()
        }, e.prototype.vertical = function (t) {
            if (void 0 === t) return this.vertical_ || !1;
            this.vertical_ = !!t, this.vertical_ ? this.addClass("vjs-slider-vertical") : this.addClass("vjs-slider-horizontal")
        }, e
    }(Tn);
    Tn.registerComponent("Slider", ii);
    var oi = function (t) {
        function e(n, r) {
            De(this, e);
            var i = Re(this, t.call(this, n, r));
            return i.partEls_ = [], i.on(n, "progress", i.update), i
        }

        return Le(e, t), e.prototype.createEl = function () {
            return t.prototype.createEl.call(this, "div", {
                className: "vjs-load-progress",
                innerHTML: '<span class="vjs-control-text"><span>' + this.localize("Loaded") + "</span>: 0%</span>"
            })
        }, e.prototype.update = function (t) {
            var e = this.player_.buffered(), n = this.player_.duration(), r = this.player_.bufferedEnd(),
                i = this.partEls_, o = function (t, e) {
                    var n = t / e || 0;
                    return 100 * (n >= 1 ? 1 : n) + "%"
                };
            this.el_.style.width = o(r, n);
            for (var s = 0; s < e.length; s++) {
                var a = e.start(s), l = e.end(s), c = i[s];
                c || (c = this.el_.appendChild(v()), i[s] = c), c.style.left = o(a, r), c.style.width = o(l - a, r)
            }
            for (var u = i.length; u > e.length; u--) this.el_.removeChild(i[u - 1]);
            i.length = e.length
        }, e
    }(Tn);
    Tn.registerComponent("LoadProgressBar", oi);
    var si = function (t) {
        function e() {
            return De(this, e), Re(this, t.apply(this, arguments))
        }

        return Le(e, t), e.prototype.createEl = function () {
            return t.prototype.createEl.call(this, "div", {className: "vjs-time-tooltip"})
        }, e.prototype.update = function (t, e, n) {
            var r = A(this.el_), i = A(this.player_.el()), o = t.width * e;
            if (i && r) {
                var s = t.left - i.left + o, a = t.width - o + (i.right - t.right), l = r.width / 2;
                s < l ? l += l - s : a < l && (l = a), l < 0 ? l = 0 : l > r.width && (l = r.width), this.el_.style.right = "-" + l + "px", y(this.el_, n)
            }
        }, e
    }(Tn);
    Tn.registerComponent("TimeTooltip", si);
    var ai = function (t) {
        function e() {
            return De(this, e), Re(this, t.apply(this, arguments))
        }

        return Le(e, t), e.prototype.createEl = function () {
            return t.prototype.createEl.call(this, "div", {
                className: "vjs-play-progress vjs-slider-bar",
                innerHTML: '<span class="vjs-control-text"><span>' + this.localize("Progress") + "</span>: 0%</span>"
            })
        }, e.prototype.update = function (t, e) {
            var n = this;
            this.rafId_ && this.cancelAnimationFrame(this.rafId_), this.rafId_ = this.requestAnimationFrame(function () {
                var r = n.player_.scrubbing() ? n.player_.getCache().currentTime : n.player_.currentTime(),
                    i = $t(r, n.player_.duration()), o = n.getChild("timeTooltip");
                o && o.update(t, e, i)
            })
        }, e
    }(Tn);
    ai.prototype.options_ = {children: []}, je && !(je > 8) || ge || _e || ai.prototype.options_.children.push("timeTooltip"), Tn.registerComponent("PlayProgressBar", ai);
    var li = function (t) {
        function e(n, r) {
            De(this, e);
            var i = Re(this, t.call(this, n, r));
            return i.update = un(cn(i, i.update), 25), i
        }

        return Le(e, t), e.prototype.createEl = function () {
            return t.prototype.createEl.call(this, "div", {className: "vjs-mouse-display"})
        }, e.prototype.update = function (t, e) {
            var n = this;
            this.rafId_ && this.cancelAnimationFrame(this.rafId_), this.rafId_ = this.requestAnimationFrame(function () {
                var r = n.player_.duration(), i = $t(e * r, r);
                n.el_.style.left = t.width * e + "px", n.getChild("timeTooltip").update(t, e, i)
            })
        }, e
    }(Tn);
    li.prototype.options_ = {children: ["timeTooltip"]}, Tn.registerComponent("MouseTimeDisplay", li);
    var ci = function (t) {
        function e(n, r) {
            De(this, e);
            var i = Re(this, t.call(this, n, r));
            return i.update = un(cn(i, i.update), 50), i.on(n, ["timeupdate", "ended"], i.update), i
        }

        return Le(e, t), e.prototype.createEl = function () {
            return t.prototype.createEl.call(this, "div", {className: "vjs-progress-holder"}, {"aria-label": this.localize("Progress Bar")})
        }, e.prototype.update = function () {
            var e = t.prototype.update.call(this), n = this.player_.duration(),
                r = this.player_.scrubbing() ? this.player_.getCache().currentTime : this.player_.currentTime();
            return this.el_.setAttribute("aria-valuenow", (100 * e).toFixed(2)), this.el_.setAttribute("aria-valuetext", this.localize("progress bar timing: currentTime={1} duration={2}", [$t(r, n), $t(n, n)], "{1} of {2}")), this.bar.update(A(this.el_), e), e
        }, e.prototype.getPercent = function () {
            var t = this.player_.scrubbing() ? this.player_.getCache().currentTime : this.player_.currentTime(),
                e = t / this.player_.duration();
            return e >= 1 ? 1 : e
        }, e.prototype.handleMouseDown = function (e) {
            this.player_.scrubbing(!0), this.videoWasPlaying = !this.player_.paused(), this.player_.pause(), t.prototype.handleMouseDown.call(this, e)
        }, e.prototype.handleMouseMove = function (t) {
            var e = this.calculateDistance(t) * this.player_.duration();
            e === this.player_.duration() && (e -= .1), this.player_.currentTime(e)
        }, e.prototype.handleMouseUp = function (e) {
            t.prototype.handleMouseUp.call(this, e), this.player_.scrubbing(!1), this.videoWasPlaying && this.player_.play()
        }, e.prototype.stepForward = function () {
            this.player_.currentTime(this.player_.currentTime() + 5)
        }, e.prototype.stepBack = function () {
            this.player_.currentTime(this.player_.currentTime() - 5)
        }, e.prototype.handleAction = function (t) {
            this.player_.paused() ? this.player_.play() : this.player_.pause()
        }, e.prototype.handleKeyPress = function (e) {
            32 === e.which || 13 === e.which ? (e.preventDefault(), this.handleAction(e)) : t.prototype.handleKeyPress && t.prototype.handleKeyPress.call(this, e)
        }, e
    }(ii);
    ci.prototype.options_ = {
        children: ["loadProgressBar", "playProgressBar"],
        barName: "playProgressBar"
    }, je && !(je > 8) || ge || _e || ci.prototype.options_.children.splice(1, 0, "mouseTimeDisplay"), ci.prototype.playerEvent = "timeupdate", Tn.registerComponent("SeekBar", ci);
    var ui = function (t) {
        function e(n, r) {
            De(this, e);
            var i = Re(this, t.call(this, n, r));
            return i.handleMouseMove = un(cn(i, i.handleMouseMove), 25), i.on(i.el_, "mousemove", i.handleMouseMove), i.throttledHandleMouseSeek = un(cn(i, i.handleMouseSeek), 25), i.on(["mousedown", "touchstart"], i.handleMouseDown), i
        }

        return Le(e, t), e.prototype.createEl = function () {
            return t.prototype.createEl.call(this, "div", {className: "vjs-progress-control vjs-control"})
        }, e.prototype.handleMouseMove = function (t) {
            var e = this.getChild("seekBar"), n = e.getChild("mouseTimeDisplay"), r = e.el(), i = A(r), o = N(r, t).x;
            o > 1 ? o = 1 : o < 0 && (o = 0), n && n.update(i, o)
        }, e.prototype.handleMouseSeek = function (t) {
            this.getChild("seekBar").handleMouseMove(t)
        }, e.prototype.handleMouseDown = function (t) {
            var e = this.el_.ownerDocument;
            this.on(e, "mousemove", this.throttledHandleMouseSeek), this.on(e, "touchmove", this.throttledHandleMouseSeek), this.on(e, "mouseup", this.handleMouseUp), this.on(e, "touchend", this.handleMouseUp)
        }, e.prototype.handleMouseUp = function (t) {
            var e = this.el_.ownerDocument;
            this.off(e, "mousemove", this.throttledHandleMouseSeek), this.off(e, "touchmove", this.throttledHandleMouseSeek), this.off(e, "mouseup", this.handleMouseUp), this.off(e, "touchend", this.handleMouseUp)
        }, e
    }(Tn);
    ui.prototype.options_ = {children: ["seekBar"]}, Tn.registerComponent("ProgressControl", ui);
    var hi = function (t) {
        function e(n, r) {
            De(this, e);
            var i = Re(this, t.call(this, n, r));
            return i.on(n, "fullscreenchange", i.handleFullscreenChange), i
        }

        return Le(e, t), e.prototype.buildCSSClass = function () {
            return "vjs-fullscreen-control " + t.prototype.buildCSSClass.call(this)
        }, e.prototype.handleFullscreenChange = function (t) {
            this.player_.isFullscreen() ? this.controlText("Non-Fullscreen") : this.controlText("Fullscreen")
        }, e.prototype.handleClick = function (t) {
            this.player_.isFullscreen() ? this.player_.exitFullscreen() : this.player_.requestFullscreen()
        }, e
    }(Yr);
    hi.prototype.controlText_ = "Fullscreen", Tn.registerComponent("FullscreenToggle", hi);
    var pi = function (t, e) {
        e.tech_ && !e.tech_.featuresVolumeControl && t.addClass("vjs-hidden"), t.on(e, "loadstart", function () {
            e.tech_.featuresVolumeControl ? t.removeClass("vjs-hidden") : t.addClass("vjs-hidden")
        })
    }, di = function (t) {
        function e() {
            return De(this, e), Re(this, t.apply(this, arguments))
        }

        return Le(e, t), e.prototype.createEl = function () {
            return t.prototype.createEl.call(this, "div", {
                className: "vjs-volume-level",
                innerHTML: '<span class="vjs-control-text"></span>'
            })
        }, e
    }(Tn);
    Tn.registerComponent("VolumeLevel", di);
    var fi = function (t) {
        function e(n, r) {
            De(this, e);
            var i = Re(this, t.call(this, n, r));
            return i.on("slideractive", i.updateLastVolume_), i.on(n, "volumechange", i.updateARIAAttributes), n.ready(function () {
                return i.updateARIAAttributes()
            }), i
        }

        return Le(e, t), e.prototype.createEl = function () {
            return t.prototype.createEl.call(this, "div", {className: "vjs-volume-bar vjs-slider-bar"}, {
                "aria-label": this.localize("Volume Level"),
                "aria-live": "polite"
            })
        }, e.prototype.handleMouseMove = function (t) {
            this.checkMuted(), this.player_.volume(this.calculateDistance(t))
        }, e.prototype.checkMuted = function () {
            this.player_.muted() && this.player_.muted(!1)
        }, e.prototype.getPercent = function () {
            return this.player_.muted() ? 0 : this.player_.volume()
        }, e.prototype.stepForward = function () {
            this.checkMuted(), this.player_.volume(this.player_.volume() + .1)
        }, e.prototype.stepBack = function () {
            this.checkMuted(), this.player_.volume(this.player_.volume() - .1)
        }, e.prototype.updateARIAAttributes = function (t) {
            var e = this.player_.muted() ? 0 : this.volumeAsPercentage_();
            this.el_.setAttribute("aria-valuenow", e), this.el_.setAttribute("aria-valuetext", e + "%")
        }, e.prototype.volumeAsPercentage_ = function () {
            return Math.round(100 * this.player_.volume())
        }, e.prototype.updateLastVolume_ = function () {
            var t = this, e = this.player_.volume();
            this.one("sliderinactive", function () {
                0 === t.player_.volume() && t.player_.lastVolume_(e)
            })
        }, e
    }(ii);
    fi.prototype.options_ = {
        children: ["volumeLevel"],
        barName: "volumeLevel"
    }, fi.prototype.playerEvent = "volumechange", Tn.registerComponent("VolumeBar", fi);
    var vi = function (t) {
        function e(n) {
            var r = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {};
            De(this, e), r.vertical = r.vertical || !1, (void 0 === r.volumeBar || o(r.volumeBar)) && (r.volumeBar = r.volumeBar || {}, r.volumeBar.vertical = r.vertical);
            var i = Re(this, t.call(this, n, r));
            return pi(i, n), i.throttledHandleMouseMove = un(cn(i, i.handleMouseMove), 25), i.on("mousedown", i.handleMouseDown), i.on("touchstart", i.handleMouseDown), i.on(i.volumeBar, ["focus", "slideractive"], function () {
                i.volumeBar.addClass("vjs-slider-active"), i.addClass("vjs-slider-active"), i.trigger("slideractive")
            }), i.on(i.volumeBar, ["blur", "sliderinactive"], function () {
                i.volumeBar.removeClass("vjs-slider-active"), i.removeClass("vjs-slider-active"), i.trigger("sliderinactive")
            }), i
        }

        return Le(e, t), e.prototype.createEl = function () {
            var e = "vjs-volume-horizontal";
            return this.options_.vertical && (e = "vjs-volume-vertical"), t.prototype.createEl.call(this, "div", {className: "vjs-volume-control vjs-control " + e})
        }, e.prototype.handleMouseDown = function (t) {
            var e = this.el_.ownerDocument;
            this.on(e, "mousemove", this.throttledHandleMouseMove), this.on(e, "touchmove", this.throttledHandleMouseMove), this.on(e, "mouseup", this.handleMouseUp), this.on(e, "touchend", this.handleMouseUp)
        }, e.prototype.handleMouseUp = function (t) {
            var e = this.el_.ownerDocument;
            this.off(e, "mousemove", this.throttledHandleMouseMove), this.off(e, "touchmove", this.throttledHandleMouseMove), this.off(e, "mouseup", this.handleMouseUp), this.off(e, "touchend", this.handleMouseUp)
        }, e.prototype.handleMouseMove = function (t) {
            this.volumeBar.handleMouseMove(t)
        }, e
    }(Tn);
    vi.prototype.options_ = {children: ["volumeBar"]}, Tn.registerComponent("VolumeControl", vi);
    var yi = function (t) {
        function e(n, r) {
            De(this, e);
            var i = Re(this, t.call(this, n, r));
            return pi(i, n), i.on(n, ["loadstart", "volumechange"], i.update), i
        }

        return Le(e, t), e.prototype.buildCSSClass = function () {
            return "vjs-mute-control " + t.prototype.buildCSSClass.call(this)
        }, e.prototype.handleClick = function (t) {
            var e = this.player_.volume(), n = this.player_.lastVolume_();
            if (0 === e) {
                var r = n < .1 ? .1 : n;
                this.player_.volume(r), this.player_.muted(!1)
            } else this.player_.muted(!this.player_.muted())
        }, e.prototype.update = function (t) {
            this.updateIcon_(), this.updateControlText_()
        }, e.prototype.updateIcon_ = function () {
            var t = this.player_.volume(), e = 3;
            0 === t || this.player_.muted() ? e = 0 : t < .33 ? e = 1 : t < .67 && (e = 2);
            for (var n = 0; n < 4; n++) b(this.el_, "vjs-vol-" + n);
            _(this.el_, "vjs-vol-" + e)
        }, e.prototype.updateControlText_ = function () {
            var t = this.player_.muted() || 0 === this.player_.volume(), e = t ? "Unmute" : "Mute";
            this.controlText() !== e && this.controlText(e)
        }, e
    }(Yr);
    yi.prototype.controlText_ = "Mute", Tn.registerComponent("MuteToggle", yi);
    var gi = function (t) {
        function e(n) {
            var r = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {};
            De(this, e), void 0 !== r.inline ? r.inline = r.inline : r.inline = !0, (void 0 === r.volumeControl || o(r.volumeControl)) && (r.volumeControl = r.volumeControl || {}, r.volumeControl.vertical = !r.inline);
            var i = Re(this, t.call(this, n, r));
            return pi(i, n), i.on(i.volumeControl, ["slideractive"], i.sliderActive_), i.on(i.muteToggle, "focus", i.sliderActive_), i.on(i.volumeControl, ["sliderinactive"], i.sliderInactive_), i.on(i.muteToggle, "blur", i.sliderInactive_), i
        }

        return Le(e, t), e.prototype.sliderActive_ = function () {
            this.addClass("vjs-slider-active")
        }, e.prototype.sliderInactive_ = function () {
            this.removeClass("vjs-slider-active")
        }, e.prototype.createEl = function () {
            var e = "vjs-volume-panel-horizontal";
            return this.options_.inline || (e = "vjs-volume-panel-vertical"), t.prototype.createEl.call(this, "div", {className: "vjs-volume-panel vjs-control " + e})
        }, e
    }(Tn);
    gi.prototype.options_ = {children: ["muteToggle", "volumeControl"]}, Tn.registerComponent("VolumePanel", gi);
    var mi = function (t) {
        function e(n, r) {
            De(this, e);
            var i = Re(this, t.call(this, n, r));
            return r && (i.menuButton_ = r.menuButton), i.focusedChild_ = -1, i.on("keydown", i.handleKeyPress), i
        }

        return Le(e, t), e.prototype.addItem = function (t) {
            this.addChild(t), t.on("click", cn(this, function (e) {
                this.menuButton_ && (this.menuButton_.unpressButton(), "CaptionSettingsMenuItem" !== t.name() && this.menuButton_.focus())
            }))
        }, e.prototype.createEl = function () {
            var e = this.options_.contentElType || "ul";
            this.contentEl_ = v(e, {className: "vjs-menu-content"}), this.contentEl_.setAttribute("role", "menu");
            var n = t.prototype.createEl.call(this, "div", {append: this.contentEl_, className: "vjs-menu"});
            return n.appendChild(this.contentEl_), z(n, "click", function (t) {
                t.preventDefault(), t.stopImmediatePropagation()
            }), n
        }, e.prototype.handleKeyPress = function (t) {
            37 === t.which || 40 === t.which ? (t.preventDefault(), this.stepForward()) : 38 !== t.which && 39 !== t.which || (t.preventDefault(), this.stepBack())
        }, e.prototype.stepForward = function () {
            var t = 0;
            void 0 !== this.focusedChild_ && (t = this.focusedChild_ + 1), this.focus(t)
        }, e.prototype.stepBack = function () {
            var t = 0;
            void 0 !== this.focusedChild_ && (t = this.focusedChild_ - 1), this.focus(t)
        }, e.prototype.focus = function () {
            var t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : 0, e = this.children().slice();
            e.length && e[0].className && /vjs-menu-title/.test(e[0].className) && e.shift(), e.length > 0 && (t < 0 ? t = 0 : t >= e.length && (t = e.length - 1), this.focusedChild_ = t, e[t].el_.focus())
        }, e
    }(Tn);
    Tn.registerComponent("Menu", mi);
    var _i = function (t) {
        function e(n) {
            var r = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {};
            De(this, e);
            var i = Re(this, t.call(this, n, r));
            i.menuButton_ = new Yr(n, r), i.menuButton_.controlText(i.controlText_), i.menuButton_.el_.setAttribute("aria-haspopup", "true");
            var o = Yr.prototype.buildCSSClass();
            return i.menuButton_.el_.className = i.buildCSSClass() + " " + o, i.menuButton_.removeClass("vjs-control"), i.addChild(i.menuButton_), i.update(), i.enabled_ = !0, i.on(i.menuButton_, "tap", i.handleClick), i.on(i.menuButton_, "click", i.handleClick), i.on(i.menuButton_, "focus", i.handleFocus), i.on(i.menuButton_, "blur", i.handleBlur), i.on("keydown", i.handleSubmenuKeyPress), i
        }

        return Le(e, t), e.prototype.update = function () {
            var t = this.createMenu();
            this.menu && this.removeChild(this.menu), this.menu = t, this.addChild(t), this.buttonPressed_ = !1, this.menuButton_.el_.setAttribute("aria-expanded", "false"), this.items && this.items.length <= this.hideThreshold_ ? this.hide() : this.show()
        }, e.prototype.createMenu = function () {
            var t = new mi(this.player_, {menuButton: this});
            if (this.hideThreshold_ = 0, this.options_.title) {
                var e = v("li", {className: "vjs-menu-title", innerHTML: J(this.options_.title), tabIndex: -1});
                this.hideThreshold_ += 1, t.children_.unshift(e), g(e, t.contentEl())
            }
            if (this.items = this.createItems(), this.items) for (var n = 0; n < this.items.length; n++) t.addItem(this.items[n]);
            return t
        }, e.prototype.createItems = function () {
        }, e.prototype.createEl = function () {
            return t.prototype.createEl.call(this, "div", {className: this.buildWrapperCSSClass()}, {})
        }, e.prototype.buildWrapperCSSClass = function () {
            var e = "vjs-menu-button";
            return !0 === this.options_.inline ? e += "-inline" : e += "-popup", "vjs-menu-button " + e + " " + Yr.prototype.buildCSSClass() + " " + t.prototype.buildCSSClass.call(this)
        }, e.prototype.buildCSSClass = function () {
            var e = "vjs-menu-button";
            return !0 === this.options_.inline ? e += "-inline" : e += "-popup", "vjs-menu-button " + e + " " + t.prototype.buildCSSClass.call(this)
        }, e.prototype.controlText = function (t) {
            var e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : this.menuButton_.el();
            return this.menuButton_.controlText(t, e)
        }, e.prototype.handleClick = function (t) {
            this.one(this.menu.contentEl(), "mouseleave", cn(this, function (t) {
                this.unpressButton(), this.el_.blur()
            })), this.buttonPressed_ ? this.unpressButton() : this.pressButton()
        }, e.prototype.focus = function () {
            this.menuButton_.focus()
        }, e.prototype.blur = function () {
            this.menuButton_.blur()
        }, e.prototype.handleFocus = function () {
            z(ue, "keydown", cn(this, this.handleKeyPress))
        }, e.prototype.handleBlur = function () {
            X(ue, "keydown", cn(this, this.handleKeyPress))
        }, e.prototype.handleKeyPress = function (t) {
            27 === t.which || 9 === t.which ? (this.buttonPressed_ && this.unpressButton(), 9 !== t.which && (t.preventDefault(), this.menuButton_.el_.focus())) : 38 !== t.which && 40 !== t.which || this.buttonPressed_ || (this.pressButton(), t.preventDefault())
        }, e.prototype.handleSubmenuKeyPress = function (t) {
            27 !== t.which && 9 !== t.which || (this.buttonPressed_ && this.unpressButton(), 9 !== t.which && (t.preventDefault(), this.menuButton_.el_.focus()))
        }, e.prototype.pressButton = function () {
            this.enabled_ && (this.buttonPressed_ = !0, this.menu.lockShowing(), this.menuButton_.el_.setAttribute("aria-expanded", "true"), ge || d() || this.menu.focus())
        }, e.prototype.unpressButton = function () {
            this.enabled_ && (this.buttonPressed_ = !1, this.menu.unlockShowing(), this.menuButton_.el_.setAttribute("aria-expanded", "false"))
        }, e.prototype.disable = function () {
            this.unpressButton(), this.enabled_ = !1, this.addClass("vjs-disabled"), this.menuButton_.disable()
        }, e.prototype.enable = function () {
            this.enabled_ = !0, this.removeClass("vjs-disabled"), this.menuButton_.enable()
        }, e
    }(Tn);
    Tn.registerComponent("MenuButton", _i);
    var bi = function (t) {
        function e(n, r) {
            De(this, e);
            var i = r.tracks, o = Re(this, t.call(this, n, r));
            if (o.items.length <= 1 && o.hide(), !i) return Re(o);
            var s = cn(o, o.update);
            return i.addEventListener("removetrack", s), i.addEventListener("addtrack", s), o.player_.on("ready", s), o.player_.on("dispose", function () {
                i.removeEventListener("removetrack", s), i.removeEventListener("addtrack", s)
            }), o
        }

        return Le(e, t), e
    }(_i);
    Tn.registerComponent("TrackButton", bi);
    var Ti = function (t) {
        function e(n, r) {
            De(this, e);
            var i = Re(this, t.call(this, n, r));
            return i.selectable = r.selectable, i.selected(r.selected), i.selectable ? i.el_.setAttribute("role", "menuitemcheckbox") : i.el_.setAttribute("role", "menuitem"), i
        }

        return Le(e, t), e.prototype.createEl = function (e, n, i) {
            return this.nonIconControl = !0, t.prototype.createEl.call(this, "li", r({
                className: "vjs-menu-item",
                innerHTML: '<span class="vjs-menu-item-text">' + this.localize(this.options_.label) + "</span>",
                tabIndex: -1
            }, n), i)
        }, e.prototype.handleClick = function (t) {
            this.selected(!0)
        }, e.prototype.selected = function (t) {
            this.selectable && (t ? (this.addClass("vjs-selected"), this.el_.setAttribute("aria-checked", "true"), this.controlText(", selected")) : (this.removeClass("vjs-selected"), this.el_.setAttribute("aria-checked", "false"), this.controlText(" ")))
        }, e
    }(Ur);
    Tn.registerComponent("MenuItem", Ti);
    var Ci = function (t) {
        function e(n, r) {
            De(this, e);
            var i = r.track, o = n.textTracks();
            r.label = i.label || i.language || "Unknown", r.selected = "showing" === i.mode;
            var s = Re(this, t.call(this, n, r));
            s.track = i;
            var a = cn(s, s.handleTracksChange), l = cn(s, s.handleSelectedLanguageChange);
            if (n.on(["loadstart", "texttrackchange"], a), o.addEventListener("change", a), o.addEventListener("selectedlanguagechange", l), s.on("dispose", function () {
                o.removeEventListener("change", a), o.removeEventListener("selectedlanguagechange", l)
            }), void 0 === o.onchange) {
                var c = void 0;
                s.on(["tap", "click"], function () {
                    if ("object" !== Ie(oe.Event)) try {
                        c = new oe.Event("change")
                    } catch (t) {
                    }
                    c || (c = ue.createEvent("Event"), c.initEvent("change", !0, !0)), o.dispatchEvent(c)
                })
            }
            return s
        }

        return Le(e, t), e.prototype.handleClick = function (e) {
            var n = this.track.kind, r = this.track.kinds, i = this.player_.textTracks();
            if (r || (r = [n]), t.prototype.handleClick.call(this, e), i) for (var o = 0; o < i.length; o++) {
                var s = i[o];
                s === this.track && r.indexOf(s.kind) > -1 ? "showing" !== s.mode && (s.mode = "showing") : "disabled" !== s.mode && (s.mode = "disabled")
            }
        }, e.prototype.handleTracksChange = function (t) {
            this.selected("showing" === this.track.mode)
        }, e.prototype.handleSelectedLanguageChange = function (t) {
            if ("showing" === this.track.mode) {
                var e = this.player_.cache_.selectedLanguage;
                if (e && e.enabled && e.language === this.track.language && e.kind !== this.track.kind) return;
                this.player_.cache_.selectedLanguage = {
                    enabled: !0,
                    language: this.track.language,
                    kind: this.track.kind
                }
            }
        }, e
    }(Ti);
    Tn.registerComponent("TextTrackMenuItem", Ci);
    var ki = function (t) {
        function e(n, r) {
            De(this, e), r.track = {
                player: n,
                kind: r.kind,
                kinds: r.kinds,
                default: !1,
                mode: "disabled"
            }, r.kinds || (r.kinds = [r.kind]), r.label ? r.track.label = r.label : r.track.label = r.kinds.join(" and ") + " off", r.selectable = !0;
            var i = Re(this, t.call(this, n, r));
            return i.selected(!0), i
        }

        return Le(e, t), e.prototype.handleTracksChange = function (t) {
            for (var e = this.player().textTracks(), n = !0, r = 0, i = e.length; r < i; r++) {
                var o = e[r];
                if (this.options_.kinds.indexOf(o.kind) > -1 && "showing" === o.mode) {
                    n = !1;
                    break
                }
            }
            this.selected(n)
        }, e.prototype.handleSelectedLanguageChange = function (t) {
            for (var e = this.player().textTracks(), n = !0, r = 0, i = e.length; r < i; r++) {
                var o = e[r];
                if (["captions", "descriptions", "subtitles"].indexOf(o.kind) > -1 && "showing" === o.mode) {
                    n = !1;
                    break
                }
            }
            n && (this.player_.cache_.selectedLanguage = {enabled: !1})
        }, e
    }(Ci);
    Tn.registerComponent("OffTextTrackMenuItem", ki);
    var wi = function (t) {
        function e(n) {
            var r = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {};
            return De(this, e), r.tracks = n.textTracks(), Re(this, t.call(this, n, r))
        }

        return Le(e, t), e.prototype.createItems = function () {
            var t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : [],
                e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : Ci, n = void 0;
            this.label_ && (n = this.label_ + " off"), t.push(new ki(this.player_, {
                kinds: this.kinds_,
                kind: this.kind_,
                label: n
            })), this.hideThreshold_ += 1;
            var r = this.player_.textTracks();
            Array.isArray(this.kinds_) || (this.kinds_ = [this.kind_]);
            for (var i = 0; i < r.length; i++) {
                var o = r[i];
                if (this.kinds_.indexOf(o.kind) > -1) {
                    var s = new e(this.player_, {track: o, selectable: !0});
                    s.addClass("vjs-" + o.kind + "-menu-item"), t.push(s)
                }
            }
            return t
        }, e
    }(bi);
    Tn.registerComponent("TextTrackButton", wi);
    var Ei = function (t) {
        function e(n, r) {
            De(this, e);
            var i = r.track, o = r.cue, s = n.currentTime();
            r.selectable = !0, r.label = o.text, r.selected = o.startTime <= s && s < o.endTime;
            var a = Re(this, t.call(this, n, r));
            return a.track = i, a.cue = o, i.addEventListener("cuechange", cn(a, a.update)), a
        }

        return Le(e, t), e.prototype.handleClick = function (e) {
            t.prototype.handleClick.call(this), this.player_.currentTime(this.cue.startTime), this.update(this.cue.startTime)
        }, e.prototype.update = function (t) {
            var e = this.cue, n = this.player_.currentTime();
            this.selected(e.startTime <= n && n < e.endTime)
        }, e
    }(Ti);
    Tn.registerComponent("ChaptersTrackMenuItem", Ei);
    var Si = function (t) {
        function e(n, r, i) {
            return De(this, e), Re(this, t.call(this, n, r, i))
        }

        return Le(e, t), e.prototype.buildCSSClass = function () {
            return "vjs-chapters-button " + t.prototype.buildCSSClass.call(this)
        }, e.prototype.buildWrapperCSSClass = function () {
            return "vjs-chapters-button " + t.prototype.buildWrapperCSSClass.call(this)
        }, e.prototype.update = function (e) {
            this.track_ && (!e || "addtrack" !== e.type && "removetrack" !== e.type) || this.setTrack(this.findChaptersTrack()), t.prototype.update.call(this)
        }, e.prototype.setTrack = function (t) {
            if (this.track_ !== t) {
                if (this.updateHandler_ || (this.updateHandler_ = this.update.bind(this)), this.track_) {
                    var e = this.player_.remoteTextTrackEls().getTrackElementByTrack_(this.track_);
                    e && e.removeEventListener("load", this.updateHandler_), this.track_ = null
                }
                if (this.track_ = t, this.track_) {
                    this.track_.mode = "hidden";
                    var n = this.player_.remoteTextTrackEls().getTrackElementByTrack_(this.track_);
                    n && n.addEventListener("load", this.updateHandler_)
                }
            }
        }, e.prototype.findChaptersTrack = function () {
            for (var t = this.player_.textTracks() || [], e = t.length - 1; e >= 0; e--) {
                var n = t[e];
                if (n.kind === this.kind_) return n
            }
        }, e.prototype.getMenuCaption = function () {
            return this.track_ && this.track_.label ? this.track_.label : this.localize(J(this.kind_))
        }, e.prototype.createMenu = function () {
            return this.options_.title = this.getMenuCaption(), t.prototype.createMenu.call(this)
        }, e.prototype.createItems = function () {
            var t = [];
            if (!this.track_) return t;
            var e = this.track_.cues;
            if (!e) return t;
            for (var n = 0, r = e.length; n < r; n++) {
                var i = e[n], o = new Ei(this.player_, {track: this.track_, cue: i});
                t.push(o)
            }
            return t
        }, e
    }(wi);
    Si.prototype.kind_ = "chapters", Si.prototype.controlText_ = "Chapters", Tn.registerComponent("ChaptersButton", Si);
    var xi = function (t) {
        function e(n, r, i) {
            De(this, e);
            var o = Re(this, t.call(this, n, r, i)), s = n.textTracks(), a = cn(o, o.handleTracksChange);
            return s.addEventListener("change", a), o.on("dispose", function () {
                s.removeEventListener("change", a)
            }), o
        }

        return Le(e, t), e.prototype.handleTracksChange = function (t) {
            for (var e = this.player().textTracks(), n = !1, r = 0, i = e.length; r < i; r++) {
                var o = e[r];
                if (o.kind !== this.kind_ && "showing" === o.mode) {
                    n = !0;
                    break
                }
            }
            n ? this.disable() : this.enable()
        }, e.prototype.buildCSSClass = function () {
            return "vjs-descriptions-button " + t.prototype.buildCSSClass.call(this)
        }, e.prototype.buildWrapperCSSClass = function () {
            return "vjs-descriptions-button " + t.prototype.buildWrapperCSSClass.call(this)
        }, e
    }(wi);
    xi.prototype.kind_ = "descriptions", xi.prototype.controlText_ = "Descriptions", Tn.registerComponent("DescriptionsButton", xi);
    var ji = function (t) {
        function e(n, r, i) {
            return De(this, e), Re(this, t.call(this, n, r, i))
        }

        return Le(e, t), e.prototype.buildCSSClass = function () {
            return "vjs-subtitles-button " + t.prototype.buildCSSClass.call(this)
        }, e.prototype.buildWrapperCSSClass = function () {
            return "vjs-subtitles-button " + t.prototype.buildWrapperCSSClass.call(this)
        }, e
    }(wi);
    ji.prototype.kind_ = "subtitles", ji.prototype.controlText_ = "Subtitles", Tn.registerComponent("SubtitlesButton", ji);
    var Ai = function (t) {
        function e(n, r) {
            De(this, e), r.track = {
                player: n,
                kind: r.kind,
                label: r.kind + " settings",
                selectable: !1,
                default: !1,
                mode: "disabled"
            }, r.selectable = !1, r.name = "CaptionSettingsMenuItem";
            var i = Re(this, t.call(this, n, r));
            return i.addClass("vjs-texttrack-settings"), i.controlText(", opens " + r.kind + " settings dialog"), i
        }

        return Le(e, t), e.prototype.handleClick = function (t) {
            this.player().getChild("textTrackSettings").open()
        }, e
    }(Ci);
    Tn.registerComponent("CaptionSettingsMenuItem", Ai);
    var Pi = function (t) {
        function e(n, r, i) {
            return De(this, e), Re(this, t.call(this, n, r, i))
        }

        return Le(e, t), e.prototype.buildCSSClass = function () {
            return "vjs-captions-button " + t.prototype.buildCSSClass.call(this)
        }, e.prototype.buildWrapperCSSClass = function () {
            return "vjs-captions-button " + t.prototype.buildWrapperCSSClass.call(this)
        }, e.prototype.createItems = function () {
            var e = [];
            return this.player().tech_ && this.player().tech_.featuresNativeTextTracks || (e.push(new Ai(this.player_, {kind: this.kind_})), this.hideThreshold_ += 1), t.prototype.createItems.call(this, e)
        }, e
    }(wi);
    Pi.prototype.kind_ = "captions", Pi.prototype.controlText_ = "Captions", Tn.registerComponent("CaptionsButton", Pi);
    var Ni = function (t) {
        function e() {
            return De(this, e), Re(this, t.apply(this, arguments))
        }

        return Le(e, t), e.prototype.createEl = function (e, n, i) {
            var o = '<span class="vjs-menu-item-text">' + this.localize(this.options_.label);
            return "captions" === this.options_.track.kind && (o += '\n        <span aria-hidden="true" class="vjs-icon-placeholder"></span>\n        <span class="vjs-control-text"> ' + this.localize("Captions") + "</span>\n      "), o += "</span>", t.prototype.createEl.call(this, e, r({innerHTML: o}, n), i)
        }, e
    }(Ci);
    Tn.registerComponent("SubsCapsMenuItem", Ni);
    var Oi = function (t) {
        function e(n) {
            var r = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {};
            De(this, e);
            var i = Re(this, t.call(this, n, r));
            return i.label_ = "subtitles", ["en", "en-us", "en-ca", "fr-ca"].indexOf(i.player_.language_) > -1 && (i.label_ = "captions"), i.menuButton_.controlText(J(i.label_)), i
        }

        return Le(e, t), e.prototype.buildCSSClass = function () {
            return "vjs-subs-caps-button " + t.prototype.buildCSSClass.call(this)
        }, e.prototype.buildWrapperCSSClass = function () {
            return "vjs-subs-caps-button " + t.prototype.buildWrapperCSSClass.call(this)
        }, e.prototype.createItems = function () {
            var e = [];
            return this.player().tech_ && this.player().tech_.featuresNativeTextTracks || (e.push(new Ai(this.player_, {kind: this.label_})), this.hideThreshold_ += 1), e = t.prototype.createItems.call(this, e, Ni)
        }, e
    }(wi);
    Oi.prototype.kinds_ = ["captions", "subtitles"], Oi.prototype.controlText_ = "Subtitles", Tn.registerComponent("SubsCapsButton", Oi);
    var Mi = function (t) {
        function e(n, r) {
            De(this, e);
            var i = r.track, o = n.audioTracks();
            r.label = i.label || i.language || "Unknown", r.selected = i.enabled;
            var s = Re(this, t.call(this, n, r));
            s.track = i;
            var a = cn(s, s.handleTracksChange);
            return o.addEventListener("change", a), s.on("dispose", function () {
                o.removeEventListener("change", a)
            }), s
        }

        return Le(e, t), e.prototype.handleClick = function (e) {
            var n = this.player_.audioTracks();
            t.prototype.handleClick.call(this, e);
            for (var r = 0; r < n.length; r++) {
                var i = n[r];
                i.enabled = i === this.track
            }
        }, e.prototype.handleTracksChange = function (t) {
            this.selected(this.track.enabled)
        }, e
    }(Ti);
    Tn.registerComponent("AudioTrackMenuItem", Mi);
    var Ii = function (t) {
        function e(n) {
            var r = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {};
            return De(this, e), r.tracks = n.audioTracks(), Re(this, t.call(this, n, r))
        }

        return Le(e, t), e.prototype.buildCSSClass = function () {
            return "vjs-audio-button " + t.prototype.buildCSSClass.call(this)
        }, e.prototype.buildWrapperCSSClass = function () {
            return "vjs-audio-button " + t.prototype.buildWrapperCSSClass.call(this)
        }, e.prototype.createItems = function () {
            var t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : [];
            this.hideThreshold_ = 1;
            for (var e = this.player_.audioTracks(), n = 0; n < e.length; n++) {
                var r = e[n];
                t.push(new Mi(this.player_, {track: r, selectable: !0}))
            }
            return t
        }, e
    }(bi);
    Ii.prototype.controlText_ = "Audio Track", Tn.registerComponent("AudioTrackButton", Ii);
    var Di = function (t) {
        function e(n, r) {
            De(this, e);
            var i = r.rate, o = parseFloat(i, 10);
            r.label = i, r.selected = 1 === o, r.selectable = !0;
            var s = Re(this, t.call(this, n, r));
            return s.label = i, s.rate = o, s.on(n, "ratechange", s.update), s
        }

        return Le(e, t), e.prototype.handleClick = function (e) {
            t.prototype.handleClick.call(this), this.player().playbackRate(this.rate)
        }, e.prototype.update = function (t) {
            this.selected(this.player().playbackRate() === this.rate)
        }, e
    }(Ti);
    Di.prototype.contentElType = "button", Tn.registerComponent("PlaybackRateMenuItem", Di);
    var Li = function (t) {
        function e(n, r) {
            De(this, e);
            var i = Re(this, t.call(this, n, r));
            return i.updateVisibility(), i.updateLabel(), i.on(n, "loadstart", i.updateVisibility), i.on(n, "ratechange", i.updateLabel), i
        }

        return Le(e, t), e.prototype.createEl = function () {
            var e = t.prototype.createEl.call(this);
            return this.labelEl_ = v("div", {
                className: "vjs-playback-rate-value",
                innerHTML: "1x"
            }), e.appendChild(this.labelEl_), e
        }, e.prototype.buildCSSClass = function () {
            return "vjs-playback-rate " + t.prototype.buildCSSClass.call(this)
        }, e.prototype.buildWrapperCSSClass = function () {
            return "vjs-playback-rate " + t.prototype.buildWrapperCSSClass.call(this)
        }, e.prototype.createMenu = function () {
            var t = new mi(this.player()), e = this.playbackRates();
            if (e) for (var n = e.length - 1; n >= 0; n--) t.addChild(new Di(this.player(), {rate: e[n] + "x"}));
            return t
        }, e.prototype.updateARIAAttributes = function () {
            this.el().setAttribute("aria-valuenow", this.player().playbackRate())
        }, e.prototype.handleClick = function (t) {
            for (var e = this.player().playbackRate(), n = this.playbackRates(), r = n[0], i = 0; i < n.length; i++) if (n[i] > e) {
                r = n[i];
                break
            }
            this.player().playbackRate(r)
        }, e.prototype.playbackRates = function () {
            return this.options_.playbackRates || this.options_.playerOptions && this.options_.playerOptions.playbackRates
        }, e.prototype.playbackRateSupported = function () {
            return this.player().tech_ && this.player().tech_.featuresPlaybackRate && this.playbackRates() && this.playbackRates().length > 0
        }, e.prototype.updateVisibility = function (t) {
            this.playbackRateSupported() ? this.removeClass("vjs-hidden") : this.addClass("vjs-hidden")
        }, e.prototype.updateLabel = function (t) {
            this.playbackRateSupported() && (this.labelEl_.innerHTML = this.player().playbackRate() + "x")
        }, e
    }(_i);
    Li.prototype.controlText_ = "Playback Rate", Tn.registerComponent("PlaybackRateMenuButton", Li);
    var Ri = function (t) {
        function e() {
            return De(this, e), Re(this, t.apply(this, arguments))
        }

        return Le(e, t), e.prototype.buildCSSClass = function () {
            return "vjs-spacer " + t.prototype.buildCSSClass.call(this)
        }, e.prototype.createEl = function () {
            return t.prototype.createEl.call(this, "div", {className: this.buildCSSClass()})
        }, e
    }(Tn);
    Tn.registerComponent("Spacer", Ri);
    var Bi = function (t) {
        function e() {
            return De(this, e), Re(this, t.apply(this, arguments))
        }

        return Le(e, t), e.prototype.buildCSSClass = function () {
            return "vjs-custom-control-spacer " + t.prototype.buildCSSClass.call(this)
        }, e.prototype.createEl = function () {
            var e = t.prototype.createEl.call(this, {className: this.buildCSSClass()});
            return e.innerHTML = "&nbsp;", e
        }, e
    }(Ri);
    Tn.registerComponent("CustomControlSpacer", Bi);
    var Fi = function (t) {
        function e() {
            return De(this, e), Re(this, t.apply(this, arguments))
        }

        return Le(e, t), e.prototype.createEl = function () {
            return t.prototype.createEl.call(this, "div", {className: "vjs-control-bar", dir: "ltr"}, {role: "group"})
        }, e
    }(Tn);
    Fi.prototype.options_ = {children: ["playToggle", "volumePanel", "currentTimeDisplay", "timeDivider", "durationDisplay", "progressControl", "liveDisplay", "remainingTimeDisplay", "customControlSpacer", "playbackRateMenuButton", "chaptersButton", "descriptionsButton", "subsCapsButton", "audioTrackButton", "fullscreenToggle"]}, Tn.registerComponent("ControlBar", Fi);
    var Vi = function (t) {
        function e(n, r) {
            De(this, e);
            var i = Re(this, t.call(this, n, r));
            return i.on(n, "error", i.open), i
        }

        return Le(e, t), e.prototype.buildCSSClass = function () {
            return "vjs-error-display " + t.prototype.buildCSSClass.call(this)
        }, e.prototype.content = function () {
            var t = this.player().error();
            return t ? this.localize(t.message) : ""
        }, e
    }(Dn);
    Vi.prototype.options_ = Z(Dn.prototype.options_, {
        pauseOnOpen: !1,
        fillAlways: !0,
        temporary: !1,
        uncloseable: !0
    }), Tn.registerComponent("ErrorDisplay", Vi);
    var Hi = ["#000", "Black"], Wi = ["#00F", "Blue"], Ui = ["#0FF", "Cyan"], zi = ["#0F0", "Green"],
        Xi = ["#F0F", "Magenta"], qi = ["#F00", "Red"], Ki = ["#FFF", "White"], Yi = ["#FF0", "Yellow"],
        Gi = ["1", "Opaque"], $i = ["0.5", "Semi-Transparent"], Ji = ["0", "Transparent"], Qi = {
            backgroundColor: {
                selector: ".vjs-bg-color > select",
                id: "captions-background-color-%s",
                label: "Color",
                options: [Hi, Ki, qi, zi, Wi, Yi, Xi, Ui]
            },
            backgroundOpacity: {
                selector: ".vjs-bg-opacity > select",
                id: "captions-background-opacity-%s",
                label: "Transparency",
                options: [Gi, $i, Ji]
            },
            color: {
                selector: ".vjs-fg-color > select",
                id: "captions-foreground-color-%s",
                label: "Color",
                options: [Ki, Hi, qi, zi, Wi, Yi, Xi, Ui]
            },
            edgeStyle: {
                selector: ".vjs-edge-style > select",
                id: "%s",
                label: "Text Edge Style",
                options: [["none", "None"], ["raised", "Raised"], ["depressed", "Depressed"], ["uniform", "Uniform"], ["dropshadow", "Dropshadow"]]
            },
            fontFamily: {
                selector: ".vjs-font-family > select",
                id: "captions-font-family-%s",
                label: "Font Family",
                options: [["proportionalSansSerif", "Proportional Sans-Serif"], ["monospaceSansSerif", "Monospace Sans-Serif"], ["proportionalSerif", "Proportional Serif"], ["monospaceSerif", "Monospace Serif"], ["casual", "Casual"], ["script", "Script"], ["small-caps", "Small Caps"]]
            },
            fontPercent: {
                selector: ".vjs-font-percent > select",
                id: "captions-font-size-%s",
                label: "Font Size",
                options: [["0.50", "50%"], ["0.75", "75%"], ["1.00", "100%"], ["1.25", "125%"], ["1.50", "150%"], ["1.75", "175%"], ["2.00", "200%"], ["3.00", "300%"], ["4.00", "400%"]],
                default: 2,
                parser: function (t) {
                    return "1.00" === t ? null : Number(t)
                }
            },
            textOpacity: {
                selector: ".vjs-text-opacity > select",
                id: "captions-foreground-opacity-%s",
                label: "Transparency",
                options: [Gi, $i]
            },
            windowColor: {selector: ".vjs-window-color > select", id: "captions-window-color-%s", label: "Color"},
            windowOpacity: {
                selector: ".vjs-window-opacity > select",
                id: "captions-window-opacity-%s",
                label: "Transparency",
                options: [Ji, $i, Gi]
            }
        };
    Qi.windowColor.options = Qi.backgroundColor.options;
    var Zi = function (t) {
        function r(n, i) {
            De(this, r), i.temporary = !1;
            var o = Re(this, t.call(this, n, i));
            return o.updateDisplay = cn(o, o.updateDisplay), o.fill(), o.hasBeenOpened_ = o.hasBeenFilled_ = !0, o.endDialog = v("p", {
                className: "vjs-control-text",
                textContent: o.localize("End of dialog window.")
            }), o.el().appendChild(o.endDialog), o.setDefaults(), void 0 === i.persistTextTrackSettings && (o.options_.persistTextTrackSettings = o.options_.playerOptions.persistTextTrackSettings), o.on(o.$(".vjs-done-button"), "click", function () {
                o.saveSettings(), o.close()
            }), o.on(o.$(".vjs-default-button"), "click", function () {
                o.setDefaults(), o.updateDisplay()
            }), e(Qi, function (t) {
                o.on(o.$(t.selector), "change", o.updateDisplay)
            }), o.options_.persistTextTrackSettings && o.restoreSettings(), o
        }

        return Le(r, t), r.prototype.createElSelect_ = function (t) {
            var e = this, n = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : "",
                r = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : "label", i = Qi[t],
                o = i.id.replace("%s", this.id_);
            return ["<" + r + ' id="' + o + '" class="' + ("label" === r ? "vjs-label" : "") + '">', this.localize(i.label), "</" + r + ">", '<select aria-labelledby="' + n + " " + o + '">'].concat(i.options.map(function (t) {
                var r = o + "-" + t[1];
                return ['<option id="' + r + '" value="' + t[0] + '" ', 'aria-labelledby="' + n + " " + o + " " + r + '">', e.localize(t[1]), "</option>"].join("")
            })).concat("</select>").join("")
        }, r.prototype.createElFgColor_ = function () {
            var t = "captions-text-legend-" + this.id_;
            return ['<fieldset class="vjs-fg-color vjs-track-setting">', '<legend id="' + t + '">', this.localize("Text"), "</legend>", this.createElSelect_("color", t), '<span class="vjs-text-opacity vjs-opacity">', this.createElSelect_("textOpacity", t), "</span>", "</fieldset>"].join("")
        }, r.prototype.createElBgColor_ = function () {
            var t = "captions-background-" + this.id_;
            return ['<fieldset class="vjs-bg-color vjs-track-setting">', '<legend id="' + t + '">', this.localize("Background"), "</legend>", this.createElSelect_("backgroundColor", t), '<span class="vjs-bg-opacity vjs-opacity">', this.createElSelect_("backgroundOpacity", t), "</span>", "</fieldset>"].join("")
        }, r.prototype.createElWinColor_ = function () {
            var t = "captions-window-" + this.id_;
            return ['<fieldset class="vjs-window-color vjs-track-setting">', '<legend id="' + t + '">', this.localize("Window"), "</legend>", this.createElSelect_("windowColor", t), '<span class="vjs-window-opacity vjs-opacity">', this.createElSelect_("windowOpacity", t), "</span>", "</fieldset>"].join("")
        }, r.prototype.createElColors_ = function () {
            return v("div", {
                className: "vjs-track-settings-colors",
                innerHTML: [this.createElFgColor_(), this.createElBgColor_(), this.createElWinColor_()].join("")
            })
        }, r.prototype.createElFont_ = function () {
            return v("div", {
                className: 'vjs-track-settings-font">',
                innerHTML: ['<fieldset class="vjs-font-percent vjs-track-setting">', this.createElSelect_("fontPercent", "", "legend"), "</fieldset>", '<fieldset class="vjs-edge-style vjs-track-setting">', this.createElSelect_("edgeStyle", "", "legend"), "</fieldset>", '<fieldset class="vjs-font-family vjs-track-setting">', this.createElSelect_("fontFamily", "", "legend"), "</fieldset>"].join("")
            })
        }, r.prototype.createElControls_ = function () {
            var t = this.localize("restore all settings to the default values");
            return v("div", {
                className: "vjs-track-settings-controls",
                innerHTML: ['<button class="vjs-default-button" title="' + t + '">', this.localize("Reset"), '<span class="vjs-control-text"> ' + t + "</span>", "</button>", '<button class="vjs-done-button">' + this.localize("Done") + "</button>"].join("")
            })
        }, r.prototype.content = function () {
            return [this.createElColors_(), this.createElFont_(), this.createElControls_()]
        }, r.prototype.label = function () {
            return this.localize("Caption Settings Dialog")
        }, r.prototype.description = function () {
            return this.localize("Beginning of dialog window. Escape will cancel and close the window.")
        }, r.prototype.buildCSSClass = function () {
            return t.prototype.buildCSSClass.call(this) + " vjs-text-track-settings"
        }, r.prototype.getValues = function () {
            var t = this;
            return n(Qi, function (e, n, r) {
                var i = Qt(t.$(n.selector), n.parser);
                return void 0 !== i && (e[r] = i), e
            }, {})
        }, r.prototype.setValues = function (t) {
            var n = this;
            e(Qi, function (e, r) {
                Zt(n.$(e.selector), t[r], e.parser)
            })
        }, r.prototype.setDefaults = function () {
            var t = this;
            e(Qi, function (e) {
                var n = e.hasOwnProperty("default") ? e.default : 0;
                t.$(e.selector).selectedIndex = n
            })
        }, r.prototype.restoreSettings = function () {
            var t = void 0;
            try {
                t = JSON.parse(oe.localStorage.getItem("vjs-text-track-settings"))
            } catch (t) {
                Xe.warn(t)
            }
            t && this.setValues(t)
        }, r.prototype.saveSettings = function () {
            if (this.options_.persistTextTrackSettings) {
                var t = this.getValues();
                try {
                    Object.keys(t).length ? oe.localStorage.setItem("vjs-text-track-settings", JSON.stringify(t)) : oe.localStorage.removeItem("vjs-text-track-settings")
                } catch (t) {
                    Xe.warn(t)
                }
            }
        }, r.prototype.updateDisplay = function () {
            var t = this.player_.getChild("textTrackDisplay");
            t && t.updateDisplay()
        }, r.prototype.conditionalBlur_ = function () {
            this.previouslyActiveEl_ = null, this.off(ue, "keydown", this.handleKeyDown);
            var t = this.player_.controlBar, e = t && t.subsCapsButton, n = t && t.captionsButton;
            e ? e.focus() : n && n.focus()
        }, r
    }(Dn);
    Tn.registerComponent("TextTrackSettings", Zi);
    var to = Be(["Text Tracks are being loaded from another origin but the crossorigin attribute isn't used.\n            This may prevent text tracks from loading."], ["Text Tracks are being loaded from another origin but the crossorigin attribute isn't used.\n            This may prevent text tracks from loading."]),
        eo = function (t) {
            function e(n, r) {
                De(this, e);
                var i = Re(this, t.call(this, n, r)), o = n.source, s = !1;
                if (o && (i.el_.currentSrc !== o.src || n.tag && 3 === n.tag.initNetworkState_) ? i.setSource(o) : i.handleLateInit_(i.el_), i.el_.hasChildNodes()) {
                    for (var a = i.el_.childNodes, l = a.length, c = []; l--;) {
                        var u = a[l];
                        "track" === u.nodeName.toLowerCase() && (i.featuresNativeTextTracks ? (i.remoteTextTrackEls().addTrackElement_(u), i.remoteTextTracks().addTrack(u.track), i.textTracks().addTrack(u.track), s || i.el_.hasAttribute("crossorigin") || !Zn(u.src) || (s = !0)) : c.push(u))
                    }
                    for (var h = 0; h < c.length; h++) i.el_.removeChild(c[h])
                }
                return i.proxyNativeTracks_(), i.featuresNativeTextTracks && s && Xe.warn(qe(to)), i.restoreMetadataTracksInIOSNativePlayer_(), (Ne || ve || Ce) && !0 === n.nativeControlsForTouch && i.setControls(!0), i.proxyWebkitFullscreen_(), i.triggerReady(), i
            }

            return Le(e, t), e.prototype.dispose = function () {
                e.disposeMediaElement(this.el_), t.prototype.dispose.call(this)
            }, e.prototype.restoreMetadataTracksInIOSNativePlayer_ = function () {
                var t = this.textTracks(), e = void 0, n = function () {
                    e = [];
                    for (var n = 0; n < t.length; n++) {
                        var r = t[n];
                        "metadata" === r.kind && e.push({track: r, storedMode: r.mode})
                    }
                };
                n(), t.addEventListener("change", n);
                var r = function n() {
                    for (var r = 0; r < e.length; r++) {
                        var i = e[r];
                        "disabled" === i.track.mode && i.track.mode !== i.storedMode && (i.track.mode = i.storedMode)
                    }
                    t.removeEventListener("change", n)
                };
                this.on("webkitbeginfullscreen", function () {
                    t.removeEventListener("change", n), t.removeEventListener("change", r), t.addEventListener("change", r)
                }), this.on("webkitendfullscreen", function () {
                    t.removeEventListener("change", n), t.addEventListener("change", n), t.removeEventListener("change", r)
                })
            }, e.prototype.proxyNativeTracks_ = function () {
                var t = this;
                br.names.forEach(function (e) {
                    var n = br[e], r = t.el()[n.getterName], i = t[n.getterName]();
                    if (t["featuresNative" + n.capitalName + "Tracks"] && r && r.addEventListener) {
                        var o = {
                            change: function (t) {
                                i.trigger({type: "change", target: i, currentTarget: i, srcElement: i})
                            }, addtrack: function (t) {
                                i.addTrack(t.track)
                            }, removetrack: function (t) {
                                i.removeTrack(t.track)
                            }
                        }, s = function () {
                            for (var t = [], e = 0; e < i.length; e++) {
                                for (var n = !1, o = 0; o < r.length; o++) if (r[o] === i[e]) {
                                    n = !0;
                                    break
                                }
                                n || t.push(i[e])
                            }
                            for (; t.length;) i.removeTrack(t.shift())
                        };
                        Object.keys(o).forEach(function (e) {
                            var n = o[e];
                            r.addEventListener(e, n), t.on("dispose", function (t) {
                                return r.removeEventListener(e, n)
                            })
                        }), t.on("loadstart", s), t.on("dispose", function (e) {
                            return t.off("loadstart", s)
                        })
                    }
                })
            }, e.prototype.createEl = function () {
                var t = this.options_.tag;
                if (!t || !this.options_.playerElIngest && !this.movingMediaElementInDOM) {
                    if (t) {
                        var n = t.cloneNode(!0);
                        t.parentNode && t.parentNode.insertBefore(n, t), e.disposeMediaElement(t), t = n
                    } else {
                        t = ue.createElement("video");
                        var i = this.options_.tag && k(this.options_.tag), o = Z({}, i);
                        Ne && !0 === this.options_.nativeControlsForTouch || delete o.controls, C(t, r(o, {
                            id: this.options_.techId,
                            class: "vjs-tech"
                        }))
                    }
                    t.playerId = this.options_.playerId
                }
                void 0 !== this.options_.preload && E(t, "preload", this.options_.preload);
                for (var s = ["loop", "muted", "playsinline", "autoplay"], a = s.length - 1; a >= 0; a--) {
                    var l = s[a], c = this.options_[l];
                    void 0 !== c && (c ? E(t, l, l) : S(t, l), t[l] = c)
                }
                return t
            }, e.prototype.handleLateInit_ = function (t) {
                if (0 !== t.networkState && 3 !== t.networkState) {
                    if (0 === t.readyState) {
                        var e = !1, n = function () {
                            e = !0
                        };
                        this.on("loadstart", n);
                        var r = function () {
                            e || this.trigger("loadstart")
                        };
                        return this.on("loadedmetadata", r), void this.ready(function () {
                            this.off("loadstart", n), this.off("loadedmetadata", r), e || this.trigger("loadstart")
                        })
                    }
                    var i = ["loadstart"];
                    i.push("loadedmetadata"), t.readyState >= 2 && i.push("loadeddata"), t.readyState >= 3 && i.push("canplay"), t.readyState >= 4 && i.push("canplaythrough"), this.ready(function () {
                        i.forEach(function (t) {
                            this.trigger(t)
                        }, this)
                    })
                }
            }, e.prototype.setCurrentTime = function (t) {
                try {
                    this.el_.currentTime = t
                } catch (t) {
                    Xe(t, "Video is not ready. (Video.js)")
                }
            }, e.prototype.duration = function () {
                var t = this;
                if (this.el_.duration === 1 / 0 && _e && Ee && 0 === this.el_.currentTime) {
                    var e = function e() {
                        t.el_.currentTime > 0 && (t.el_.duration === 1 / 0 && t.trigger("durationchange"), t.off("timeupdate", e))
                    };
                    return this.on("timeupdate", e), NaN
                }
                return this.el_.duration || NaN
            }, e.prototype.width = function () {
                return this.el_.offsetWidth
            }, e.prototype.height = function () {
                return this.el_.offsetHeight
            }, e.prototype.proxyWebkitFullscreen_ = function () {
                var t = this;
                if ("webkitDisplayingFullscreen" in this.el_) {
                    var e = function () {
                        this.trigger("fullscreenchange", {isFullscreen: !1})
                    }, n = function () {
                        "webkitPresentationMode" in this.el_ && "picture-in-picture" !== this.el_.webkitPresentationMode && (this.one("webkitendfullscreen", e), this.trigger("fullscreenchange", {isFullscreen: !0}))
                    };
                    this.on("webkitbeginfullscreen", n), this.on("dispose", function () {
                        t.off("webkitbeginfullscreen", n), t.off("webkitendfullscreen", e)
                    })
                }
            }, e.prototype.supportsFullScreen = function () {
                if ("function" == typeof this.el_.webkitEnterFullScreen) {
                    var t = oe.navigator && oe.navigator.userAgent || "";
                    if (/Android/.test(t) || !/Chrome|Mac OS X 10.5/.test(t)) return !0
                }
                return !1
            }, e.prototype.enterFullScreen = function () {
                var t = this.el_;
                t.paused && t.networkState <= t.HAVE_METADATA ? (this.el_.play(), this.setTimeout(function () {
                    t.pause(), t.webkitEnterFullScreen()
                }, 0)) : t.webkitEnterFullScreen()
            }, e.prototype.exitFullScreen = function () {
                this.el_.webkitExitFullScreen()
            }, e.prototype.src = function (t) {
                if (void 0 === t) return this.el_.src;
                this.setSrc(t)
            }, e.prototype.reset = function () {
                e.resetMediaElement(this.el_)
            }, e.prototype.currentSrc = function () {
                return this.currentSource_ ? this.currentSource_.src : this.el_.currentSrc
            }, e.prototype.setControls = function (t) {
                this.el_.controls = !!t
            }, e.prototype.addTextTrack = function (e, n, r) {
                return this.featuresNativeTextTracks ? this.el_.addTextTrack(e, n, r) : t.prototype.addTextTrack.call(this, e, n, r)
            }, e.prototype.createRemoteTextTrack = function (e) {
                if (!this.featuresNativeTextTracks) return t.prototype.createRemoteTextTrack.call(this, e);
                var n = ue.createElement("track");
                return e.kind && (n.kind = e.kind), e.label && (n.label = e.label), (e.language || e.srclang) && (n.srclang = e.language || e.srclang), e.default && (n.default = e.default), e.id && (n.id = e.id), e.src && (n.src = e.src), n
            }, e.prototype.addRemoteTextTrack = function (e, n) {
                var r = t.prototype.addRemoteTextTrack.call(this, e, n);
                return this.featuresNativeTextTracks && this.el().appendChild(r), r
            }, e.prototype.removeRemoteTextTrack = function (e) {
                if (t.prototype.removeRemoteTextTrack.call(this, e), this.featuresNativeTextTracks) for (var n = this.$$("track"), r = n.length; r--;) e !== n[r] && e !== n[r].track || this.el().removeChild(n[r])
            }, e.prototype.getVideoPlaybackQuality = function () {
                if ("function" == typeof this.el().getVideoPlaybackQuality) return this.el().getVideoPlaybackQuality();
                var t = {};
                return void 0 !== this.el().webkitDroppedFrameCount && void 0 !== this.el().webkitDecodedFrameCount && (t.droppedVideoFrames = this.el().webkitDroppedFrameCount, t.totalVideoFrames = this.el().webkitDecodedFrameCount), oe.performance && "function" == typeof oe.performance.now ? t.creationTime = oe.performance.now() : oe.performance && oe.performance.timing && "number" == typeof oe.performance.timing.navigationStart && (t.creationTime = oe.Date.now() - oe.performance.timing.navigationStart), t
            }, e
        }(Rr);
    if (h()) {
        eo.TEST_VID = ue.createElement("video");
        var no = ue.createElement("track");
        no.kind = "captions", no.srclang = "en", no.label = "English", eo.TEST_VID.appendChild(no)
    }
    eo.isSupported = function () {
        try {
            eo.TEST_VID.volume = .5
        } catch (t) {
            return !1
        }
        return !(!eo.TEST_VID || !eo.TEST_VID.canPlayType)
    }, eo.canPlayType = function (t) {
        return eo.TEST_VID.canPlayType(t)
    }, eo.canPlaySource = function (t, e) {
        return eo.canPlayType(t.type)
    }, eo.canControlVolume = function () {
        try {
            var t = eo.TEST_VID.volume;
            return eo.TEST_VID.volume = t / 2 + .1, t !== eo.TEST_VID.volume
        } catch (t) {
            return !1
        }
    }, eo.canControlPlaybackRate = function () {
        if (_e && Ee && Se < 58) return !1;
        try {
            var t = eo.TEST_VID.playbackRate;
            return eo.TEST_VID.playbackRate = t / 2 + .1, t !== eo.TEST_VID.playbackRate
        } catch (t) {
            return !1
        }
    }, eo.supportsNativeTextTracks = function () {
        return Pe
    }, eo.supportsNativeVideoTracks = function () {
        return !(!eo.TEST_VID || !eo.TEST_VID.videoTracks)
    }, eo.supportsNativeAudioTracks = function () {
        return !(!eo.TEST_VID || !eo.TEST_VID.audioTracks)
    }, eo.Events = ["loadstart", "suspend", "abort", "error", "emptied", "stalled", "loadedmetadata", "loadeddata", "canplay", "canplaythrough", "playing", "waiting", "seeking", "seeked", "ended", "durationchange", "timeupdate", "progress", "play", "pause", "ratechange", "resize", "volumechange"], eo.prototype.featuresVolumeControl = eo.canControlVolume(), eo.prototype.featuresPlaybackRate = eo.canControlPlaybackRate(), eo.prototype.movingMediaElementInDOM = !ge, eo.prototype.featuresFullscreenResize = !0, eo.prototype.featuresProgressEvents = !0, eo.prototype.featuresTimeupdateEvents = !0, eo.prototype.featuresNativeTextTracks = eo.supportsNativeTextTracks(), eo.prototype.featuresNativeVideoTracks = eo.supportsNativeVideoTracks(), eo.prototype.featuresNativeAudioTracks = eo.supportsNativeAudioTracks();
    var ro = eo.TEST_VID && eo.TEST_VID.constructor.prototype.canPlayType,
        io = /^application\/(?:x-|vnd\.apple\.)mpegurl/i, oo = /^video\/mp4/i;
    eo.patchCanPlayType = function () {
        be >= 4 && !ke ? eo.TEST_VID.constructor.prototype.canPlayType = function (t) {
            return t && io.test(t) ? "maybe" : ro.call(this, t)
        } : Te && (eo.TEST_VID.constructor.prototype.canPlayType = function (t) {
            return t && oo.test(t) ? "maybe" : ro.call(this, t)
        })
    }, eo.unpatchCanPlayType = function () {
        var t = eo.TEST_VID.constructor.prototype.canPlayType;
        return eo.TEST_VID.constructor.prototype.canPlayType = ro, t
    }, eo.patchCanPlayType(), eo.disposeMediaElement = function (t) {
        if (t) {
            for (t.parentNode && t.parentNode.removeChild(t); t.hasChildNodes();) t.removeChild(t.firstChild);
            t.removeAttribute("src"), "function" == typeof t.load && function () {
                try {
                    t.load()
                } catch (t) {
                }
            }()
        }
    }, eo.resetMediaElement = function (t) {
        if (t) {
            for (var e = t.querySelectorAll("source"), n = e.length; n--;) t.removeChild(e[n]);
            t.removeAttribute("src"), "function" == typeof t.load && function () {
                try {
                    t.load()
                } catch (t) {
                }
            }()
        }
    }, ["muted", "defaultMuted", "autoplay", "controls", "loop", "playsinline"].forEach(function (t) {
        eo.prototype[t] = function () {
            return this.el_[t] || this.el_.hasAttribute(t)
        }
    }), ["muted", "defaultMuted", "autoplay", "loop", "playsinline"].forEach(function (t) {
        eo.prototype["set" + J(t)] = function (e) {
            this.el_[t] = e, e ? this.el_.setAttribute(t, t) : this.el_.removeAttribute(t)
        }
    }), ["paused", "currentTime", "buffered", "volume", "poster", "preload", "error", "seeking", "seekable", "ended", "playbackRate", "defaultPlaybackRate", "played", "networkState", "readyState", "videoWidth", "videoHeight"].forEach(function (t) {
        eo.prototype[t] = function () {
            return this.el_[t]
        }
    }), ["volume", "src", "poster", "preload", "playbackRate", "defaultPlaybackRate"].forEach(function (t) {
        eo.prototype["set" + J(t)] = function (e) {
            this.el_[t] = e
        }
    }), ["pause", "load", "play"].forEach(function (t) {
        eo.prototype[t] = function () {
            return this.el_[t]()
        }
    }), Rr.withSourceHandlers(eo), eo.nativeSourceHandler = {}, eo.nativeSourceHandler.canPlayType = function (t) {
        try {
            return eo.TEST_VID.canPlayType(t)
        } catch (t) {
            return ""
        }
    }, eo.nativeSourceHandler.canHandleSource = function (t, e) {
        if (t.type) return eo.nativeSourceHandler.canPlayType(t.type);
        if (t.src) {
            var n = Qn(t.src);
            return eo.nativeSourceHandler.canPlayType("video/" + n)
        }
        return ""
    }, eo.nativeSourceHandler.handleSource = function (t, e, n) {
        e.setSrc(t.src)
    }, eo.nativeSourceHandler.dispose = function () {
    }, eo.registerSourceHandler(eo.nativeSourceHandler), Rr.registerTech("Html5", eo);
    var so = Be(["\n        Using the tech directly can be dangerous. I hope you know what you're doing.\n        See https://github.com/videojs/video.js/issues/2617 for more info.\n      "], ["\n        Using the tech directly can be dangerous. I hope you know what you're doing.\n        See https://github.com/videojs/video.js/issues/2617 for more info.\n      "]),
        ao = ["progress", "abort", "suspend", "emptied", "stalled", "loadedmetadata", "loadeddata", "timeupdate", "ratechange", "resize", "volumechange", "texttrackchange"],
        lo = function (t) {
            function e(n, i, o) {
                if (De(this, e), n.id = n.id || "vjs_video_" + R(), i = r(e.getTagSettings(n), i), i.initChildren = !1, i.createEl = !1, i.reportTouchActivity = !1, !i.language) if ("function" == typeof n.closest) {
                    var s = n.closest("[lang]");
                    s && (i.language = s.getAttribute("lang"))
                } else for (var a = n; a && 1 === a.nodeType;) {
                    if (k(a).hasOwnProperty("lang")) {
                        i.language = a.getAttribute("lang");
                        break
                    }
                    a = a.parentNode
                }
                var l = Re(this, t.call(this, null, i, o));
                if (l.isReady_ = !1, !l.options_ || !l.options_.techOrder || !l.options_.techOrder.length) throw new Error("No techOrder specified. Did you overwrite videojs.options instead of just changing the properties you want to override?");
                if (l.tag = n, l.tagAttributes = n && k(n), l.language(l.options_.language), i.languages) {
                    var c = {};
                    Object.getOwnPropertyNames(i.languages).forEach(function (t) {
                        c[t.toLowerCase()] = i.languages[t]
                    }), l.languages_ = c
                } else l.languages_ = e.prototype.options_.languages;
                l.cache_ = {}, l.poster_ = i.poster || "", l.controls_ = !!i.controls, l.cache_.lastVolume = 1, n.controls = !1, l.scrubbing_ = !1, l.el_ = l.createEl(), G(l, {eventBusKey: "el_"});
                var u = Z(l.options_);
                if (i.plugins) {
                    var h = i.plugins;
                    Object.keys(h).forEach(function (t) {
                        if ("function" != typeof this[t]) throw new Error('plugin "' + t + '" does not exist');
                        this[t](h[t])
                    }, l)
                }
                l.options_.playerOptions = u, l.middleware_ = [], l.initChildren(), l.isAudio("audio" === n.nodeName.toLowerCase()), l.controls() ? l.addClass("vjs-controls-enabled") : l.addClass("vjs-controls-disabled"), l.el_.setAttribute("role", "region"), l.isAudio() ? l.el_.setAttribute("aria-label", l.localize("Audio Player")) : l.el_.setAttribute("aria-label", l.localize("Video Player")), l.isAudio() && l.addClass("vjs-audio"), l.flexNotSupported_() && l.addClass("vjs-no-flex"), ge || l.addClass("vjs-workinghover"), e.players[l.id_] = l;
                var p = ne.split(".")[0];
                return l.addClass("vjs-v" + p), l.userActive(!0), l.reportUserActivity(), l.listenForUserActivity_(), l.on("fullscreenchange", l.handleFullscreenChange_), l.on("stageclick", l.handleStageClick_), l.changingSrc_ = !1, l
            }

            return Le(e, t), e.prototype.dispose = function () {
                this.trigger("dispose"), this.off("dispose"), this.styleEl_ && this.styleEl_.parentNode && this.styleEl_.parentNode.removeChild(this.styleEl_), e.players[this.id_] = null, this.tag && this.tag.player && (this.tag.player = null), this.el_ && this.el_.player && (this.el_.player = null), this.tech_ && this.tech_.dispose(), t.prototype.dispose.call(this)
            }, e.prototype.createEl = function () {
                var e = this.tag, n = void 0,
                    r = this.playerElIngest_ = e.parentNode && e.parentNode.hasAttribute && e.parentNode.hasAttribute("data-vjs-player");
                n = this.el_ = r ? e.parentNode : t.prototype.createEl.call(this, "div"), e.setAttribute("tabindex", "-1"), e.removeAttribute("width"), e.removeAttribute("height");
                var i = k(e);
                if (Object.getOwnPropertyNames(i).forEach(function (t) {
                    "class" === t ? n.className += " " + i[t] : n.setAttribute(t, i[t])
                }), e.playerId = e.id, e.id += "_html5_api", e.className = "vjs-tech", e.player = n.player = this, this.addClass("vjs-paused"), !0 !== oe.VIDEOJS_NO_DYNAMIC_STYLE) {
                    this.styleEl_ = an("vjs-styles-dimensions");
                    var o = Ye(".vjs-styles-defaults"), s = Ye("head");
                    s.insertBefore(this.styleEl_, o ? o.nextSibling : s.firstChild)
                }
                this.width(this.options_.width), this.height(this.options_.height), this.fluid(this.options_.fluid), this.aspectRatio(this.options_.aspectRatio);
                for (var a = e.getElementsByTagName("a"), l = 0; l < a.length; l++) {
                    var c = a.item(l);
                    _(c, "vjs-hidden"), c.setAttribute("hidden", "hidden")
                }
                return e.initNetworkState_ = e.networkState, e.parentNode && !r && e.parentNode.insertBefore(n, e), g(e, n), this.children_.unshift(e), this.el_.setAttribute("lang", this.language_), this.el_ = n, n
            }, e.prototype.width = function (t) {
                return this.dimension("width", t)
            }, e.prototype.height = function (t) {
                return this.dimension("height", t)
            }, e.prototype.dimension = function (t, e) {
                var n = t + "_";
                if (void 0 === e) return this[n] || 0;
                if ("" === e) this[n] = void 0; else {
                    var r = parseFloat(e);
                    if (isNaN(r)) return void Xe.error('Improper value "' + e + '" supplied for for ' + t);
                    this[n] = r
                }
                this.updateStyleEl_()
            }, e.prototype.fluid = function (t) {
                if (void 0 === t) return !!this.fluid_;
                this.fluid_ = !!t, t ? this.addClass("vjs-fluid") : this.removeClass("vjs-fluid"), this.updateStyleEl_()
            }, e.prototype.aspectRatio = function (t) {
                if (void 0 === t) return this.aspectRatio_;
                if (!/^\d+\:\d+$/.test(t)) throw new Error("Improper value supplied for aspect ratio. The format should be width:height, for example 16:9.");
                this.aspectRatio_ = t, this.fluid(!0), this.updateStyleEl_()
            }, e.prototype.updateStyleEl_ = function () {
                if (!0 === oe.VIDEOJS_NO_DYNAMIC_STYLE) {
                    var t = "number" == typeof this.width_ ? this.width_ : this.options_.width,
                        e = "number" == typeof this.height_ ? this.height_ : this.options_.height,
                        n = this.tech_ && this.tech_.el();
                    return void(n && (t >= 0 && (n.width = t), e >= 0 && (n.height = e)))
                }
                var r = void 0, i = void 0, o = void 0, s = void 0;
                o = void 0 !== this.aspectRatio_ && "auto" !== this.aspectRatio_ ? this.aspectRatio_ : this.videoWidth() > 0 ? this.videoWidth() + ":" + this.videoHeight() : "16:9";
                var a = o.split(":"), l = a[1] / a[0];
                r = void 0 !== this.width_ ? this.width_ : void 0 !== this.height_ ? this.height_ / l : this.videoWidth() || 300, i = void 0 !== this.height_ ? this.height_ : r * l, s = /^[^a-zA-Z]/.test(this.id()) ? "dimensions-" + this.id() : this.id() + "-dimensions", this.addClass(s), ln(this.styleEl_, "\n      ." + s + " {\n        width: " + r + "px;\n        height: " + i + "px;\n      }\n\n      ." + s + ".vjs-fluid {\n        padding-top: " + 100 * l + "%;\n      }\n    ")
            }, e.prototype.loadTech_ = function (t, e) {
                var n = this;
                this.tech_ && this.unloadTech_();
                var i = J(t), o = t.charAt(0).toLowerCase() + t.slice(1);
                "Html5" !== i && this.tag && (Rr.getTech("Html5").disposeMediaElement(this.tag), this.tag.player = null, this.tag = null), this.techName_ = i, this.isReady_ = !1;
                var s = {
                    source: e,
                    nativeControlsForTouch: this.options_.nativeControlsForTouch,
                    playerId: this.id(),
                    techId: this.id() + "_" + i + "_api",
                    autoplay: this.options_.autoplay,
                    playsinline: this.options_.playsinline,
                    preload: this.options_.preload,
                    loop: this.options_.loop,
                    muted: this.options_.muted,
                    poster: this.poster(),
                    language: this.language(),
                    playerElIngest: this.playerElIngest_ || !1,
                    "vtt.js": this.options_["vtt.js"]
                };
                Cr.names.forEach(function (t) {
                    var e = Cr[t];
                    s[e.getterName] = n[e.privateName]
                }), r(s, this.options_[i]), r(s, this.options_[o]), r(s, this.options_[t.toLowerCase()]), this.tag && (s.tag = this.tag), e && e.src === this.cache_.src && this.cache_.currentTime > 0 && (s.startTime = this.cache_.currentTime);
                var a = Rr.getTech(t);
                if (!a) throw new Error("No Tech named '" + i + "' exists! '" + i + "' should be registered using videojs.registerTech()'");
                this.tech_ = new a(s), this.tech_.ready(cn(this, this.handleTechReady_), !0), Mn.jsonToTextTracks(this.textTracksJson_ || [], this.tech_), ao.forEach(function (t) {
                    n.on(n.tech_, t, n["handleTech" + J(t) + "_"])
                }), this.on(this.tech_, "loadstart", this.handleTechLoadStart_), this.on(this.tech_, "waiting", this.handleTechWaiting_), this.on(this.tech_, "canplay", this.handleTechCanPlay_), this.on(this.tech_, "canplaythrough", this.handleTechCanPlayThrough_),
                    this.on(this.tech_, "playing", this.handleTechPlaying_), this.on(this.tech_, "ended", this.handleTechEnded_), this.on(this.tech_, "seeking", this.handleTechSeeking_), this.on(this.tech_, "seeked", this.handleTechSeeked_), this.on(this.tech_, "play", this.handleTechPlay_), this.on(this.tech_, "firstplay", this.handleTechFirstPlay_), this.on(this.tech_, "pause", this.handleTechPause_), this.on(this.tech_, "durationchange", this.handleTechDurationChange_), this.on(this.tech_, "fullscreenchange", this.handleTechFullscreenChange_), this.on(this.tech_, "error", this.handleTechError_), this.on(this.tech_, "loadedmetadata", this.updateStyleEl_), this.on(this.tech_, "posterchange", this.handleTechPosterChange_), this.on(this.tech_, "textdata", this.handleTechTextData_), this.usingNativeControls(this.techGet_("controls")), this.controls() && !this.usingNativeControls() && this.addTechControlsListeners_(), this.tech_.el().parentNode === this.el() || "Html5" === i && this.tag || g(this.tech_.el(), this.el()), this.tag && (this.tag.player = null, this.tag = null)
            }, e.prototype.unloadTech_ = function () {
                var t = this;
                Cr.names.forEach(function (e) {
                    var n = Cr[e];
                    t[n.privateName] = t[n.getterName]()
                }), this.textTracksJson_ = Mn.textTracksToJson(this.tech_), this.isReady_ = !1, this.tech_.dispose(), this.tech_ = !1
            }, e.prototype.tech = function (t) {
                return void 0 === t && Xe.warn(qe(so)), this.tech_
            }, e.prototype.addTechControlsListeners_ = function () {
                this.removeTechControlsListeners_(), this.on(this.tech_, "mousedown", this.handleTechClick_), this.on(this.tech_, "touchstart", this.handleTechTouchStart_), this.on(this.tech_, "touchmove", this.handleTechTouchMove_), this.on(this.tech_, "touchend", this.handleTechTouchEnd_), this.on(this.tech_, "tap", this.handleTechTap_)
            }, e.prototype.removeTechControlsListeners_ = function () {
                this.off(this.tech_, "tap", this.handleTechTap_), this.off(this.tech_, "touchstart", this.handleTechTouchStart_), this.off(this.tech_, "touchmove", this.handleTechTouchMove_), this.off(this.tech_, "touchend", this.handleTechTouchEnd_), this.off(this.tech_, "mousedown", this.handleTechClick_)
            }, e.prototype.handleTechReady_ = function () {
                if (this.triggerReady(), this.cache_.volume && this.techCall_("setVolume", this.cache_.volume), this.handleTechPosterChange_(), this.handleTechDurationChange_(), (this.src() || this.currentSrc()) && this.tag && this.options_.autoplay && this.paused()) try {
                    delete this.tag.poster
                } catch (t) {
                    Xe("deleting tag.poster throws in some browsers", t)
                }
            }, e.prototype.handleTechLoadStart_ = function () {
                this.removeClass("vjs-ended"), this.removeClass("vjs-seeking"), this.error(null), this.paused() ? (this.hasStarted(!1), this.trigger("loadstart")) : (this.trigger("loadstart"), this.trigger("firstplay"))
            }, e.prototype.hasStarted = function (t) {
                return void 0 !== t ? void(this.hasStarted_ !== t && (this.hasStarted_ = t, t ? (this.addClass("vjs-has-started"), this.trigger("firstplay")) : this.removeClass("vjs-has-started"))) : !!this.hasStarted_
            }, e.prototype.handleTechPlay_ = function () {
                this.removeClass("vjs-ended"), this.removeClass("vjs-paused"), this.addClass("vjs-playing"), this.hasStarted(!0), this.trigger("play")
            }, e.prototype.handleTechWaiting_ = function () {
                var t = this;
                this.addClass("vjs-waiting"), this.trigger("waiting"), this.one("timeupdate", function () {
                    return t.removeClass("vjs-waiting")
                })
            }, e.prototype.handleTechCanPlay_ = function () {
                this.removeClass("vjs-waiting"), this.trigger("canplay")
            }, e.prototype.handleTechCanPlayThrough_ = function () {
                this.removeClass("vjs-waiting"), this.trigger("canplaythrough")
            }, e.prototype.handleTechPlaying_ = function () {
                this.removeClass("vjs-waiting"), this.trigger("playing")
            }, e.prototype.handleTechSeeking_ = function () {
                this.addClass("vjs-seeking"), this.trigger("seeking")
            }, e.prototype.handleTechSeeked_ = function () {
                this.removeClass("vjs-seeking"), this.trigger("seeked")
            }, e.prototype.handleTechFirstPlay_ = function () {
                this.options_.starttime && (Xe.warn("Passing the `starttime` option to the player will be deprecated in 6.0"), this.currentTime(this.options_.starttime)), this.addClass("vjs-has-started"), this.trigger("firstplay")
            }, e.prototype.handleTechPause_ = function () {
                this.removeClass("vjs-playing"), this.addClass("vjs-paused"), this.trigger("pause")
            }, e.prototype.handleTechEnded_ = function () {
                this.addClass("vjs-ended"), this.options_.loop ? (this.currentTime(0), this.play()) : this.paused() || this.pause(), this.trigger("ended")
            }, e.prototype.handleTechDurationChange_ = function () {
                this.duration(this.techGet_("duration"))
            }, e.prototype.handleTechClick_ = function (t) {
                0 === t.button && this.controls() && (this.paused() ? this.play() : this.pause())
            }, e.prototype.handleTechTap_ = function () {
                this.userActive(!this.userActive())
            }, e.prototype.handleTechTouchStart_ = function () {
                this.userWasActive = this.userActive()
            }, e.prototype.handleTechTouchMove_ = function () {
                this.userWasActive && this.reportUserActivity()
            }, e.prototype.handleTechTouchEnd_ = function (t) {
                t.preventDefault()
            }, e.prototype.handleFullscreenChange_ = function () {
                this.isFullscreen() ? this.addClass("vjs-fullscreen") : this.removeClass("vjs-fullscreen")
            }, e.prototype.handleStageClick_ = function () {
                this.reportUserActivity()
            }, e.prototype.handleTechFullscreenChange_ = function (t, e) {
                e && this.isFullscreen(e.isFullscreen), this.trigger("fullscreenchange")
            }, e.prototype.handleTechError_ = function () {
                var t = this.tech_.error();
                this.error(t)
            }, e.prototype.handleTechTextData_ = function () {
                var t = null;
                arguments.length > 1 && (t = arguments[1]), this.trigger("textdata", t)
            }, e.prototype.getCache = function () {
                return this.cache_
            }, e.prototype.techCall_ = function (t, e) {
                this.ready(function () {
                    if (t in Vr) return Xt(this.middleware_, this.tech_, t, e);
                    try {
                        this.tech_ && this.tech_[t](e)
                    } catch (t) {
                        throw Xe(t), t
                    }
                }, !0)
            }, e.prototype.techGet_ = function (t) {
                if (this.tech_ && this.tech_.isReady_) {
                    if (t in Fr) return zt(this.middleware_, this.tech_, t);
                    try {
                        return this.tech_[t]()
                    } catch (e) {
                        throw void 0 === this.tech_[t] ? Xe("Video.js: " + t + " method not defined for " + this.techName_ + " playback technology.", e) : "TypeError" === e.name ? (Xe("Video.js: " + t + " unavailable on " + this.techName_ + " playback technology element.", e), this.tech_.isReady_ = !1) : Xe(e), e
                    }
                }
            }, e.prototype.play = function () {
                if (this.changingSrc_) this.ready(function () {
                    var t = this.techGet_("play");
                    void 0 !== t && "function" == typeof t.then && t.then(null, function (t) {
                    })
                }); else {
                    if (this.isReady_ && (this.src() || this.currentSrc())) return this.techGet_("play");
                    this.ready(function () {
                        this.tech_.one("loadstart", function () {
                            var t = this.play();
                            void 0 !== t && "function" == typeof t.then && t.then(null, function (t) {
                            })
                        })
                    })
                }
            }, e.prototype.pause = function () {
                this.techCall_("pause")
            }, e.prototype.paused = function () {
                return !1 !== this.techGet_("paused")
            }, e.prototype.played = function () {
                return this.techGet_("played") || rt(0, 0)
            }, e.prototype.scrubbing = function (t) {
                if (void 0 === t) return this.scrubbing_;
                this.scrubbing_ = !!t, t ? this.addClass("vjs-scrubbing") : this.removeClass("vjs-scrubbing")
            }, e.prototype.currentTime = function (t) {
                return void 0 !== t ? void this.techCall_("setCurrentTime", t) : (this.cache_.currentTime = this.techGet_("currentTime") || 0, this.cache_.currentTime)
            }, e.prototype.duration = function (t) {
                if (void 0 === t) return void 0 !== this.cache_.duration ? this.cache_.duration : NaN;
                t = parseFloat(t), t < 0 && (t = 1 / 0), t !== this.cache_.duration && (this.cache_.duration = t, t === 1 / 0 ? this.addClass("vjs-live") : this.removeClass("vjs-live"), this.trigger("durationchange"))
            }, e.prototype.remainingTime = function () {
                return this.duration() - this.currentTime()
            }, e.prototype.remainingTimeDisplay = function () {
                return Math.floor(this.duration()) - Math.floor(this.currentTime())
            }, e.prototype.buffered = function () {
                var t = this.techGet_("buffered");
                return t && t.length || (t = rt(0, 0)), t
            }, e.prototype.bufferedPercent = function () {
                return it(this.buffered(), this.duration())
            }, e.prototype.bufferedEnd = function () {
                var t = this.buffered(), e = this.duration(), n = t.end(t.length - 1);
                return n > e && (n = e), n
            }, e.prototype.volume = function (t) {
                var e = void 0;
                return void 0 !== t ? (e = Math.max(0, Math.min(1, parseFloat(t))), this.cache_.volume = e, this.techCall_("setVolume", e), void(e > 0 && this.lastVolume_(e))) : (e = parseFloat(this.techGet_("volume")), isNaN(e) ? 1 : e)
            }, e.prototype.muted = function (t) {
                return void 0 !== t ? void this.techCall_("setMuted", t) : this.techGet_("muted") || !1
            }, e.prototype.defaultMuted = function (t) {
                return void 0 !== t ? this.techCall_("setDefaultMuted", t) : this.techGet_("defaultMuted") || !1
            }, e.prototype.lastVolume_ = function (t) {
                return void 0 !== t && 0 !== t ? void(this.cache_.lastVolume = t) : this.cache_.lastVolume
            }, e.prototype.supportsFullScreen = function () {
                return this.techGet_("supportsFullScreen") || !1
            }, e.prototype.isFullscreen = function (t) {
                return void 0 !== t ? void(this.isFullscreen_ = !!t) : !!this.isFullscreen_
            }, e.prototype.requestFullscreen = function () {
                var t = Cn;
                this.isFullscreen(!0), t.requestFullscreen ? (z(ue, t.fullscreenchange, cn(this, function e(n) {
                    this.isFullscreen(ue[t.fullscreenElement]), !1 === this.isFullscreen() && X(ue, t.fullscreenchange, e), this.trigger("fullscreenchange")
                })), this.el_[t.requestFullscreen]()) : this.tech_.supportsFullScreen() ? this.techCall_("enterFullScreen") : (this.enterFullWindow(), this.trigger("fullscreenchange"))
            }, e.prototype.exitFullscreen = function () {
                var t = Cn;
                this.isFullscreen(!1), t.requestFullscreen ? ue[t.exitFullscreen]() : this.tech_.supportsFullScreen() ? this.techCall_("exitFullScreen") : (this.exitFullWindow(), this.trigger("fullscreenchange"))
            }, e.prototype.enterFullWindow = function () {
                this.isFullWindow = !0, this.docOrigOverflow = ue.documentElement.style.overflow, z(ue, "keydown", cn(this, this.fullWindowOnEscKey)), ue.documentElement.style.overflow = "hidden", _(ue.body, "vjs-full-window"), this.trigger("enterFullWindow")
            }, e.prototype.fullWindowOnEscKey = function (t) {
                27 === t.keyCode && (!0 === this.isFullscreen() ? this.exitFullscreen() : this.exitFullWindow())
            }, e.prototype.exitFullWindow = function () {
                this.isFullWindow = !1, X(ue, "keydown", this.fullWindowOnEscKey), ue.documentElement.style.overflow = this.docOrigOverflow, b(ue.body, "vjs-full-window"), this.trigger("exitFullWindow")
            }, e.prototype.canPlayType = function (t) {
                for (var e = void 0, n = 0, r = this.options_.techOrder; n < r.length; n++) {
                    var i = r[n], o = Rr.getTech(i);
                    if (o || (o = Tn.getComponent(i)), o) {
                        if (o.isSupported() && (e = o.canPlayType(t))) return e
                    } else Xe.error('The "' + i + '" tech is undefined. Skipped browser support check for that tech.')
                }
                return ""
            }, e.prototype.selectSource = function (t) {
                var e = this, n = this.options_.techOrder.map(function (t) {
                    return [t, Rr.getTech(t)]
                }).filter(function (t) {
                    var e = t[0], n = t[1];
                    return n ? n.isSupported() : (Xe.error('The "' + e + '" tech is undefined. Skipped browser support check for that tech.'), !1)
                }), r = function (t, e, n) {
                    var r = void 0;
                    return t.some(function (t) {
                        return e.some(function (e) {
                            if (r = n(t, e)) return !0
                        })
                    }), r
                }, i = function (t, n) {
                    var r = t[0];
                    if (t[1].canPlaySource(n, e.options_[r.toLowerCase()])) return {source: n, tech: r}
                };
                return (this.options_.sourceOrder ? r(t, n, function (t) {
                    return function (e, n) {
                        return t(n, e)
                    }
                }(i)) : r(n, t, i)) || !1
            }, e.prototype.src = function (t) {
                var e = this;
                if (void 0 === t) return this.cache_.src;
                var n = Hr(t);
                if (!n.length) return void this.setTimeout(function () {
                    this.error({code: 4, message: this.localize(this.options_.notSupportedMessage)})
                }, 0);
                this.cache_.sources = n, this.changingSrc_ = !0, this.cache_.source = n[0], Wt(this, n[0], function (t, r) {
                    if (e.middleware_ = r, e.src_(t)) return n.length > 1 ? e.src(n.slice(1)) : (e.setTimeout(function () {
                        this.error({code: 4, message: this.localize(this.options_.notSupportedMessage)})
                    }, 0), void e.triggerReady());
                    e.changingSrc_ = !1, e.cache_.src = t.src, Ut(r, e.tech_)
                })
            }, e.prototype.src_ = function (t) {
                var e = this.selectSource([t]);
                return !e || (Q(e.tech, this.techName_) ? (this.ready(function () {
                    this.tech_.constructor.prototype.hasOwnProperty("setSource") ? this.techCall_("setSource", t) : this.techCall_("src", t.src), "auto" === this.options_.preload && this.load()
                }, !0), !1) : (this.changingSrc_ = !0, this.loadTech_(e.tech, e.source), !1))
            }, e.prototype.load = function () {
                this.techCall_("load")
            }, e.prototype.reset = function () {
                this.loadTech_(this.options_.techOrder[0], null), this.techCall_("reset")
            }, e.prototype.currentSources = function () {
                var t = this.currentSource(), e = [];
                return 0 !== Object.keys(t).length && e.push(t), this.cache_.sources || e
            }, e.prototype.currentSource = function () {
                return this.cache_.source || {}
            }, e.prototype.currentSrc = function () {
                return this.currentSource() && this.currentSource().src || ""
            }, e.prototype.currentType = function () {
                return this.currentSource() && this.currentSource().type || ""
            }, e.prototype.preload = function (t) {
                return void 0 !== t ? (this.techCall_("setPreload", t), void(this.options_.preload = t)) : this.techGet_("preload")
            }, e.prototype.autoplay = function (t) {
                return void 0 !== t ? (this.techCall_("setAutoplay", t), void(this.options_.autoplay = t)) : this.techGet_("autoplay", t)
            }, e.prototype.playsinline = function (t) {
                return void 0 !== t ? (this.techCall_("setPlaysinline", t), this.options_.playsinline = t, this) : this.techGet_("playsinline")
            }, e.prototype.loop = function (t) {
                return void 0 !== t ? (this.techCall_("setLoop", t), void(this.options_.loop = t)) : this.techGet_("loop")
            }, e.prototype.poster = function (t) {
                if (void 0 === t) return this.poster_;
                t || (t = ""), this.poster_ = t, this.techCall_("setPoster", t), this.trigger("posterchange")
            }, e.prototype.handleTechPosterChange_ = function () {
                !this.poster_ && this.tech_ && this.tech_.poster && (this.poster_ = this.tech_.poster() || "", this.trigger("posterchange"))
            }, e.prototype.controls = function (t) {
                return void 0 !== t ? (t = !!t, void(this.controls_ !== t && (this.controls_ = t, this.usingNativeControls() && this.techCall_("setControls", t), t ? (this.removeClass("vjs-controls-disabled"), this.addClass("vjs-controls-enabled"), this.trigger("controlsenabled"), this.usingNativeControls() || this.addTechControlsListeners_()) : (this.removeClass("vjs-controls-enabled"), this.addClass("vjs-controls-disabled"), this.trigger("controlsdisabled"), this.usingNativeControls() || this.removeTechControlsListeners_())))) : !!this.controls_
            }, e.prototype.usingNativeControls = function (t) {
                return void 0 !== t ? (t = !!t, void(this.usingNativeControls_ !== t && (this.usingNativeControls_ = t, t ? (this.addClass("vjs-using-native-controls"), this.trigger("usingnativecontrols")) : (this.removeClass("vjs-using-native-controls"), this.trigger("usingcustomcontrols"))))) : !!this.usingNativeControls_
            }, e.prototype.error = function (t) {
                return void 0 === t ? this.error_ || null : null === t ? (this.error_ = t, this.removeClass("vjs-error"), void(this.errorDisplay && this.errorDisplay.close())) : (this.error_ = new ot(t), this.addClass("vjs-error"), Xe.error("(CODE:" + this.error_.code + " " + ot.errorTypes[this.error_.code] + ")", this.error_.message, this.error_), void this.trigger("error"))
            }, e.prototype.reportUserActivity = function (t) {
                this.userActivity_ = !0
            }, e.prototype.userActive = function (t) {
                return void 0 !== t ? void((t = !!t) !== this.userActive_ && (this.userActive_ = t, t ? (this.userActivity_ = !0, this.removeClass("vjs-user-inactive"), this.addClass("vjs-user-active"), this.trigger("useractive")) : (this.userActivity_ = !1, this.tech_ && this.tech_.one("mousemove", function (t) {
                    t.stopPropagation(), t.preventDefault()
                }), this.removeClass("vjs-user-active"), this.addClass("vjs-user-inactive"), this.trigger("userinactive")))) : this.userActive_
            }, e.prototype.listenForUserActivity_ = function () {
                var t = void 0, e = void 0, n = void 0, r = cn(this, this.reportUserActivity), i = function (t) {
                    t.screenX === e && t.screenY === n || (e = t.screenX, n = t.screenY, r())
                }, o = function () {
                    r(), this.clearInterval(t), t = this.setInterval(r, 250)
                }, s = function (e) {
                    r(), this.clearInterval(t)
                };
                this.on("mousedown", o), this.on("mousemove", i), this.on("mouseup", s), this.on("keydown", r), this.on("keyup", r);
                var a = void 0;
                this.setInterval(function () {
                    if (this.userActivity_) {
                        this.userActivity_ = !1, this.userActive(!0), this.clearTimeout(a);
                        var t = this.options_.inactivityTimeout;
                        t > 0 && (a = this.setTimeout(function () {
                            this.userActivity_ || this.userActive(!1)
                        }, t))
                    }
                }, 250)
            }, e.prototype.playbackRate = function (t) {
                return void 0 !== t ? void this.techCall_("setPlaybackRate", t) : this.tech_ && this.tech_.featuresPlaybackRate ? this.techGet_("playbackRate") : 1
            }, e.prototype.defaultPlaybackRate = function (t) {
                return void 0 !== t ? this.techCall_("setDefaultPlaybackRate", t) : this.tech_ && this.tech_.featuresPlaybackRate ? this.techGet_("defaultPlaybackRate") : 1
            }, e.prototype.isAudio = function (t) {
                return void 0 !== t ? void(this.isAudio_ = !!t) : !!this.isAudio_
            }, e.prototype.addTextTrack = function (t, e, n) {
                if (this.tech_) return this.tech_.addTextTrack(t, e, n)
            }, e.prototype.addRemoteTextTrack = function (t, e) {
                if (this.tech_) return this.tech_.addRemoteTextTrack(t, e)
            }, e.prototype.removeRemoteTextTrack = function () {
                var t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {}, e = t.track,
                    n = void 0 === e ? arguments[0] : e;
                if (this.tech_) return this.tech_.removeRemoteTextTrack(n)
            }, e.prototype.getVideoPlaybackQuality = function () {
                return this.techGet_("getVideoPlaybackQuality")
            }, e.prototype.videoWidth = function () {
                return this.tech_ && this.tech_.videoWidth && this.tech_.videoWidth() || 0
            }, e.prototype.videoHeight = function () {
                return this.tech_ && this.tech_.videoHeight && this.tech_.videoHeight() || 0
            }, e.prototype.language = function (t) {
                if (void 0 === t) return this.language_;
                this.language_ = String(t).toLowerCase()
            }, e.prototype.languages = function () {
                return Z(e.prototype.options_.languages, this.languages_)
            }, e.prototype.toJSON = function () {
                var t = Z(this.options_), e = t.tracks;
                t.tracks = [];
                for (var n = 0; n < e.length; n++) {
                    var r = e[n];
                    r = Z(r), r.player = void 0, t.tracks[n] = r
                }
                return t
            }, e.prototype.createModal = function (t, e) {
                var n = this;
                e = e || {}, e.content = t || "";
                var r = new Dn(this, e);
                return this.addChild(r), r.on("dispose", function () {
                    n.removeChild(r)
                }), r.open(), r
            }, e.getTagSettings = function (t) {
                var e = {sources: [], tracks: []}, n = k(t), i = n["data-setup"];
                if (m(t, "vjs-fluid") && (n.fluid = !0), null !== i) {
                    var o = An(i || "{}"), s = o[0], a = o[1];
                    s && Xe.error(s), r(n, a)
                }
                if (r(e, n), t.hasChildNodes()) for (var l = t.childNodes, c = 0, u = l.length; c < u; c++) {
                    var h = l[c], p = h.nodeName.toLowerCase();
                    "source" === p ? e.sources.push(k(h)) : "track" === p && e.tracks.push(k(h))
                }
                return e
            }, e.prototype.flexNotSupported_ = function () {
                var t = ue.createElement("i");
                return !("flexBasis" in t.style || "webkitFlexBasis" in t.style || "mozFlexBasis" in t.style || "msFlexBasis" in t.style || "msFlexOrder" in t.style)
            },e
        }(Tn);
    Cr.names.forEach(function (t) {
        var e = Cr[t];
        lo.prototype[e.getterName] = function () {
            return this.tech_ ? this.tech_[e.getterName]() : (this[e.privateName] = this[e.privateName] || new e.ListClass, this[e.privateName])
        }
    }), lo.players = {};
    var co = oe.navigator;
    lo.prototype.options_ = {
        techOrder: Rr.defaultTechOrder_,
        html5: {},
        flash: {},
        inactivityTimeout: 2e3,
        playbackRates: [],
        children: ["mediaLoader", "posterImage", "textTrackDisplay", "loadingSpinner", "bigPlayButton", "controlBar", "errorDisplay", "textTrackSettings"],
        language: co && (co.languages && co.languages[0] || co.userLanguage || co.language) || "en",
        languages: {},
        notSupportedMessage: "No compatible source was found for this media."
    }, ["ended", "seeking", "seekable", "networkState", "readyState"].forEach(function (t) {
        lo.prototype[t] = function () {
            return this.techGet_(t)
        }
    }), ao.forEach(function (t) {
        lo.prototype["handleTech" + J(t) + "_"] = function () {
            return this.trigger(t)
        }
    }), Tn.registerComponent("Player", lo);
    var uo = {}, ho = function (t) {
        return uo.hasOwnProperty(t)
    }, po = function (t) {
        return ho(t) ? uo[t] : void 0
    }, fo = function (t, e) {
        t.activePlugins_ = t.activePlugins_ || {}, t.activePlugins_[e] = !0
    }, vo = function (t, e, n) {
        var r = (n ? "before" : "") + "pluginsetup";
        t.trigger(r, e), t.trigger(r + ":" + e.name, e)
    }, yo = function (t, e) {
        var n = function () {
            vo(this, {name: t, plugin: e, instance: null}, !0);
            var n = e.apply(this, arguments);
            return fo(this, t), vo(this, {name: t, plugin: e, instance: n}), n
        };
        return Object.keys(e).forEach(function (t) {
            n[t] = e[t]
        }), n
    }, go = function (t, e) {
        return e.prototype.name = t, function () {
            vo(this, {name: t, plugin: e, instance: null}, !0);
            for (var n = arguments.length, r = Array(n), i = 0; i < n; i++) r[i] = arguments[i];
            var o = new (Function.prototype.bind.apply(e, [null].concat([this].concat(r))));
            return this[t] = function () {
                return o
            }, vo(this, o.getEventHash()), o
        }
    }, mo = function () {
        function t(e) {
            if (De(this, t), this.constructor === t) throw new Error("Plugin must be sub-classed; not directly instantiated.");
            this.player = e, G(this), delete this.trigger, $(this, this.constructor.defaultState), fo(e, this.name), this.dispose = cn(this, this.dispose), e.on("dispose", this.dispose)
        }

        return t.prototype.getEventHash = function () {
            var t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {};
            return t.name = this.name, t.plugin = this.constructor, t.instance = this, t
        }, t.prototype.trigger = function (t) {
            var e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {};
            return q(this.eventBusEl_, t, this.getEventHash(e))
        }, t.prototype.handleStateChanged = function (t) {
        }, t.prototype.dispose = function () {
            var t = this.name, e = this.player;
            this.trigger("dispose"), this.off(), e.off("dispose", this.dispose), e.activePlugins_[t] = !1, this.player = this.state = null, e[t] = go(t, uo[t])
        }, t.isBasic = function (e) {
            var n = "string" == typeof e ? po(e) : e;
            return "function" == typeof n && !t.prototype.isPrototypeOf(n.prototype)
        }, t.registerPlugin = function (e, n) {
            if ("string" != typeof e) throw new Error('Illegal plugin name, "' + e + '", must be a string, was ' + (void 0 === e ? "undefined" : Ie(e)) + ".");
            if (ho(e)) Xe.warn('A plugin named "' + e + '" already exists. You may want to avoid re-registering plugins!'); else if (lo.prototype.hasOwnProperty(e)) throw new Error('Illegal plugin name, "' + e + '", cannot share a name with an existing player method!');
            if ("function" != typeof n) throw new Error('Illegal plugin for "' + e + '", must be a function, was ' + (void 0 === n ? "undefined" : Ie(n)) + ".");
            return uo[e] = n, "plugin" !== e && (t.isBasic(n) ? lo.prototype[e] = yo(e, n) : lo.prototype[e] = go(e, n)), n
        }, t.deregisterPlugin = function (t) {
            if ("plugin" === t) throw new Error("Cannot de-register base plugin.");
            ho(t) && (delete uo[t], delete lo.prototype[t])
        }, t.getPlugins = function () {
            var t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : Object.keys(uo), e = void 0;
            return t.forEach(function (t) {
                var n = po(t);
                n && (e = e || {}, e[t] = n)
            }), e
        }, t.getPluginVersion = function (t) {
            var e = po(t);
            return e && e.VERSION || ""
        }, t
    }();
    mo.getPlugin = po, mo.BASE_PLUGIN_NAME = "plugin", mo.registerPlugin("plugin", mo), lo.prototype.usingPlugin = function (t) {
        return !!this.activePlugins_ && !0 === this.activePlugins_[t]
    }, lo.prototype.hasPlugin = function (t) {
        return !!ho(t)
    };
    var _o = function (t, e) {
        if ("function" != typeof e && null !== e) throw new TypeError("Super expression must either be null or a function, not " + (void 0 === e ? "undefined" : Ie(e)));
        t.prototype = Object.create(e && e.prototype, {
            constructor: {
                value: t,
                enumerable: !1,
                writable: !0,
                configurable: !0
            }
        }), e && (t.super_ = e)
    }, bo = function (t) {
        var e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {}, n = function () {
            t.apply(this, arguments)
        }, r = {};
        "object" === (void 0 === e ? "undefined" : Ie(e)) ? (e.constructor !== Object.prototype.constructor && (n = e.constructor), r = e) : "function" == typeof e && (n = e), _o(n, t);
        for (var i in r) r.hasOwnProperty(i) && (n.prototype[i] = r[i]);
        return n
    };
    if ("undefined" == typeof HTMLVideoElement && h() && (ue.createElement("video"), ue.createElement("audio"), ue.createElement("track")), te.hooks_ = {}, te.hooks = function (t, e) {
        return te.hooks_[t] = te.hooks_[t] || [], e && (te.hooks_[t] = te.hooks_[t].concat(e)), te.hooks_[t]
    }, te.hook = function (t, e) {
        te.hooks(t, e)
    }, te.removeHook = function (t, e) {
        var n = te.hooks(t).indexOf(e);
        return !(n <= -1) && (te.hooks_[t] = te.hooks_[t].slice(), te.hooks_[t].splice(n, 1), !0)
    }, !0 !== oe.VIDEOJS_NO_DYNAMIC_STYLE && h()) {
        var To = Ye(".vjs-styles-defaults");
        if (!To) {
            To = an("vjs-styles-defaults");
            var Co = Ye("head");
            Co && Co.insertBefore(To, Co.firstChild), ln(To, "\n      .video-js {\n        width: 300px;\n        height: 150px;\n      }\n\n      .vjs-fluid {\n        padding-top: 56.25%\n      }\n    ")
        }
    }
    return Y(1, te), te.VERSION = ne, te.options = lo.prototype.options_, te.getPlayers = function () {
        return lo.players
    }, te.players = lo.players, te.getComponent = Tn.getComponent, te.registerComponent = function (t, e) {
        Rr.isTech(e) && Xe.warn("The " + t + " tech was registered as a component. It should instead be registered using videojs.registerTech(name, tech)"), Tn.registerComponent.call(Tn, t, e)
    }, te.getTech = Rr.getTech, te.registerTech = Rr.registerTech, te.use = Ht, te.browser = Me, te.TOUCH_ENABLED = Ne, te.extend = bo, te.mergeOptions = Z, te.bind = cn, te.registerPlugin = mo.registerPlugin, te.plugin = function (t, e) {
        return Xe.warn("videojs.plugin() is deprecated; use videojs.registerPlugin() instead"), mo.registerPlugin(t, e)
    }, te.getPlugins = mo.getPlugins, te.getPlugin = mo.getPlugin, te.getPluginVersion = mo.getPluginVersion, te.addLanguage = function (t, e) {
        var n;
        return t = ("" + t).toLowerCase(), te.options.languages = Z(te.options.languages, (n = {}, n[t] = e, n)), te.options.languages[t]
    }, te.log = Xe, te.createTimeRange = te.createTimeRanges = rt, te.formatTime = $t, te.parseUrl = $n, te.isCrossOrigin = Zn, te.EventTarget = hn, te.on = z, te.one = K, te.off = X, te.trigger = q, te.xhr = hr, te.TextTrack = fr, te.AudioTrack = vr, te.VideoTrack = yr, ["isEl", "isTextNode", "createEl", "hasClass", "addClass", "removeClass", "toggleClass", "setAttributes", "getAttributes", "emptyEl", "appendContent", "insertContent"].forEach(function (t) {
        te[t] = function () {
            return Xe.warn("videojs." + t + "() is deprecated; use videojs.dom." + t + "() instead"), $e[t].apply(null, arguments)
        }
    }), te.computedStyle = a, te.dom = $e, te.url = tr, te
});
