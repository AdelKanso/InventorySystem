/*!
   Copyright 2010-2019 SpryMedia Ltd.

 This source file is free software, available under the following license:
   MIT license - http://datatables.net/license/mit

 This source file is distributed in the hope that it will be useful, but
 WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
 or FITNESS FOR A PARTICULAR PURPOSE. See the license files for details.

 For details please refer to: http://www.datatables.net
 ColReorder 1.5.2
 ©2010-2019 SpryMedia Ltd - datatables.net/license
*/
(function(d) { "function" === typeof define && define.amd ? define(["jquery", "datatables.net"], function(t) { return d(t, window, document) }) : "object" === typeof exports ? module.exports = function(t, r) { t || (t = window);
        r && r.fn.dataTable || (r = require("datatables.net")(t, r).$); return d(r, t, t.document) } : d(jQuery, window, document) })(function(d, t, r, w) {
    function v(a) { for (var b = [], c = 0, d = a.length; c < d; c++) b[a[c]] = c; return b }

    function u(a, b, c) { b = a.splice(b, 1)[0];
        a.splice(c, 0, b) }

    function x(a, b, c) {
        for (var d = [], h = 0, f = a.childNodes.length; h <
            f; h++) 1 == a.childNodes[h].nodeType && d.push(a.childNodes[h]);
        b = d[b];
        null !== c ? a.insertBefore(b, d[c]) : a.appendChild(b)
    }
    var y = d.fn.dataTable;
    d.fn.dataTableExt.oApi.fnColReorder = function(a, b, c, g, h) {
        var f, p, n = a.aoColumns.length;
        var q = function(a, b, c) { if (a[b] && "function" !== typeof a[b]) { var e = a[b].split("."),
                    d = e.shift();
                isNaN(1 * d) || (a[b] = c[1 * d] + "." + e.join(".")) } };
        if (b != c)
            if (0 > b || b >= n) this.oApi._fnLog(a, 1, "ColReorder 'from' index is out of bounds: " + b);
            else if (0 > c || c >= n) this.oApi._fnLog(a, 1, "ColReorder 'to' index is out of bounds: " +
            c);
        else {
            var l = [];
            var e = 0;
            for (f = n; e < f; e++) l[e] = e;
            u(l, b, c);
            var k = v(l);
            e = 0;
            for (f = a.aaSorting.length; e < f; e++) a.aaSorting[e][0] = k[a.aaSorting[e][0]];
            if (null !== a.aaSortingFixed)
                for (e = 0, f = a.aaSortingFixed.length; e < f; e++) a.aaSortingFixed[e][0] = k[a.aaSortingFixed[e][0]];
            e = 0;
            for (f = n; e < f; e++) { var m = a.aoColumns[e];
                l = 0; for (p = m.aDataSort.length; l < p; l++) m.aDataSort[l] = k[m.aDataSort[l]];
                m.idx = k[m.idx] }
            d.each(a.aLastSort, function(b, c) { a.aLastSort[b].src = k[c.src] });
            e = 0;
            for (f = n; e < f; e++) m = a.aoColumns[e], "number" == typeof m.mData ?
                m.mData = k[m.mData] : d.isPlainObject(m.mData) && (q(m.mData, "_", k), q(m.mData, "filter", k), q(m.mData, "sort", k), q(m.mData, "type", k));
            if (a.aoColumns[b].bVisible) {
                q = this.oApi._fnColumnIndexToVisible(a, b);
                p = null;
                for (e = c < b ? c : c + 1; null === p && e < n;) p = this.oApi._fnColumnIndexToVisible(a, e), e++;
                l = a.nTHead.getElementsByTagName("tr");
                e = 0;
                for (f = l.length; e < f; e++) x(l[e], q, p);
                if (null !== a.nTFoot)
                    for (l = a.nTFoot.getElementsByTagName("tr"), e = 0, f = l.length; e < f; e++) x(l[e], q, p);
                e = 0;
                for (f = a.aoData.length; e < f; e++) null !== a.aoData[e].nTr &&
                    x(a.aoData[e].nTr, q, p)
            }
            u(a.aoColumns, b, c);
            e = 0;
            for (f = n; e < f; e++) a.oApi._fnColumnOptions(a, e, {});
            u(a.aoPreSearchCols, b, c);
            e = 0;
            for (f = a.aoData.length; e < f; e++) { p = a.aoData[e]; if (m = p.anCells)
                    for (u(m, b, c), l = 0, q = m.length; l < q; l++) m[l] && m[l]._DT_CellIndex && (m[l]._DT_CellIndex.column = l); "dom" !== p.src && d.isArray(p._aData) && u(p._aData, b, c) }
            e = 0;
            for (f = a.aoHeader.length; e < f; e++) u(a.aoHeader[e], b, c);
            if (null !== a.aoFooter)
                for (e = 0, f = a.aoFooter.length; e < f; e++) u(a.aoFooter[e], b, c);
            (h || h === w) && d.fn.dataTable.Api(a).rows().invalidate();
            e = 0;
            for (f = n; e < f; e++) d(a.aoColumns[e].nTh).off(".DT"), this.oApi._fnSortAttachListener(a, a.aoColumns[e].nTh, e);
            d(a.oInstance).trigger("column-reorder.dt", [a, { from: b, to: c, mapping: k, drop: g, iFrom: b, iTo: c, aiInvertMapping: k }])
        }
    };
    var k = function(a, b) {
        a = (new d.fn.dataTable.Api(a)).settings()[0];
        if (a._colReorder) return a._colReorder;
        !0 === b && (b = {});
        var c = d.fn.dataTable.camelToHungarian;
        c && (c(k.defaults, k.defaults, !0), c(k.defaults, b || {}));
        this.s = {
            dt: null,
            enable: null,
            init: d.extend(!0, {}, k.defaults, b),
            fixed: 0,
            fixedRight: 0,
            reorderCallback: null,
            mouse: { startX: -1, startY: -1, offsetX: -1, offsetY: -1, target: -1, targetIndex: -1, fromIndex: -1 },
            aoTargets: []
        };
        this.dom = { drag: null, pointer: null };
        this.s.enable = this.s.init.bEnable;
        this.s.dt = a;
        this.s.dt._colReorder = this;
        this._fnConstruct();
        return this
    };
    d.extend(k.prototype, {
        fnEnable: function(a) { if (!1 === a) return fnDisable();
            this.s.enable = !0 },
        fnDisable: function() { this.s.enable = !1 },
        fnReset: function() { this._fnOrderColumns(this.fnOrder()); return this },
        fnGetCurrentOrder: function() { return this.fnOrder() },
        fnOrder: function(a, b) { var c = [],
                g, h = this.s.dt.aoColumns; if (a === w) { b = 0; for (g = h.length; b < g; b++) c.push(h[b]._ColReorder_iOrigCol); return c } if (b) { h = this.fnOrder();
                b = 0; for (g = a.length; b < g; b++) c.push(d.inArray(a[b], h));
                a = c }
            this._fnOrderColumns(v(a)); return this },
        fnTranspose: function(a, b) {
            b || (b = "toCurrent");
            var c = this.fnOrder(),
                g = this.s.dt.aoColumns;
            return "toCurrent" === b ? d.isArray(a) ? d.map(a, function(a) { return d.inArray(a, c) }) : d.inArray(a, c) : d.isArray(a) ? d.map(a, function(a) { return g[a]._ColReorder_iOrigCol }) :
                g[a]._ColReorder_iOrigCol
        },
        _fnConstruct: function() {
            var a = this,
                b = this.s.dt.aoColumns.length,
                c = this.s.dt.nTable,
                g;
            this.s.init.iFixedColumns && (this.s.fixed = this.s.init.iFixedColumns);
            this.s.init.iFixedColumnsLeft && (this.s.fixed = this.s.init.iFixedColumnsLeft);
            this.s.fixedRight = this.s.init.iFixedColumnsRight ? this.s.init.iFixedColumnsRight : 0;
            this.s.init.fnReorderCallback && (this.s.reorderCallback = this.s.init.fnReorderCallback);
            for (g = 0; g < b; g++) g > this.s.fixed - 1 && g < b - this.s.fixedRight && this._fnMouseListener(g,
                this.s.dt.aoColumns[g].nTh), this.s.dt.aoColumns[g]._ColReorder_iOrigCol = g;
            this.s.dt.oApi._fnCallbackReg(this.s.dt, "aoStateSaveParams", function(b, c) { a._fnStateSave.call(a, c) }, "ColReorder_State");
            var h = null;
            this.s.init.aiOrder && (h = this.s.init.aiOrder.slice());
            this.s.dt.oLoadedState && "undefined" != typeof this.s.dt.oLoadedState.ColReorder && this.s.dt.oLoadedState.ColReorder.length == this.s.dt.aoColumns.length && (h = this.s.dt.oLoadedState.ColReorder);
            if (h)
                if (a.s.dt._bInitComplete) b = v(h), a._fnOrderColumns.call(a,
                    b);
                else { var f = !1;
                    d(c).on("draw.dt.colReorder", function() { if (!a.s.dt._bInitComplete && !f) { f = !0; var b = v(h);
                            a._fnOrderColumns.call(a, b) } }) }
            else this._fnSetColumnIndexes();
            d(c).on("destroy.dt.colReorder", function() { d(c).off("destroy.dt.colReorder draw.dt.colReorder");
                d.each(a.s.dt.aoColumns, function(a, b) { d(b.nTh).off(".ColReorder");
                    d(b.nTh).removeAttr("data-column-index") });
                a.s.dt._colReorder = null;
                a.s = null })
        },
        _fnOrderColumns: function(a) {
            var b = !1;
            if (a.length != this.s.dt.aoColumns.length) this.s.dt.oInstance.oApi._fnLog(this.s.dt,
                1, "ColReorder - array reorder does not match known number of columns. Skipping.");
            else { for (var c = 0, g = a.length; c < g; c++) { var h = d.inArray(c, a);
                    c != h && (u(a, h, c), this.s.dt.oInstance.fnColReorder(h, c, !0, !1), b = !0) }
                this._fnSetColumnIndexes();
                b && (d.fn.dataTable.Api(this.s.dt).rows().invalidate(), "" === this.s.dt.oScroll.sX && "" === this.s.dt.oScroll.sY || this.s.dt.oInstance.fnAdjustColumnSizing(!1), this.s.dt.oInstance.oApi._fnSaveState(this.s.dt), null !== this.s.reorderCallback && this.s.reorderCallback.call(this)) }
        },
        _fnStateSave: function(a) {
            var b, c, g = this.s.dt.aoColumns;
            a.ColReorder = [];
            if (a.aaSorting) { for (b = 0; b < a.aaSorting.length; b++) a.aaSorting[b][0] = g[a.aaSorting[b][0]]._ColReorder_iOrigCol; var h = d.extend(!0, [], a.aoSearchCols);
                b = 0; for (c = g.length; b < c; b++) { var f = g[b]._ColReorder_iOrigCol;
                    a.aoSearchCols[f] = h[b];
                    a.abVisCols[f] = g[b].bVisible;
                    a.ColReorder.push(f) } } else if (a.order) {
                for (b = 0; b < a.order.length; b++) a.order[b][0] = g[a.order[b][0]]._ColReorder_iOrigCol;
                h = d.extend(!0, [], a.columns);
                b = 0;
                for (c = g.length; b < c; b++) f =
                    g[b]._ColReorder_iOrigCol, a.columns[f] = h[b], a.ColReorder.push(f)
            }
        },
        _fnMouseListener: function(a, b) { var c = this;
            d(b).on("mousedown.ColReorder", function(a) { c.s.enable && 1 === a.which && c._fnMouseDown.call(c, a, b) }).on("touchstart.ColReorder", function(a) { c.s.enable && c._fnMouseDown.call(c, a, b) }) },
        _fnMouseDown: function(a, b) {
            var c = this,
                g = d(a.target).closest("th, td").offset();
            b = parseInt(d(b).attr("data-column-index"), 10);
            b !== w && (this.s.mouse.startX = this._fnCursorPosition(a, "pageX"), this.s.mouse.startY = this._fnCursorPosition(a,
                "pageY"), this.s.mouse.offsetX = this._fnCursorPosition(a, "pageX") - g.left, this.s.mouse.offsetY = this._fnCursorPosition(a, "pageY") - g.top, this.s.mouse.target = this.s.dt.aoColumns[b].nTh, this.s.mouse.targetIndex = b, this.s.mouse.fromIndex = b, this._fnRegions(), d(r).on("mousemove.ColReorder touchmove.ColReorder", function(a) { c._fnMouseMove.call(c, a) }).on("mouseup.ColReorder touchend.ColReorder", function(a) { c._fnMouseUp.call(c, a) }))
        },
        _fnMouseMove: function(a) {
            var b = this;
            if (null === this.dom.drag) {
                if (5 > Math.pow(Math.pow(this._fnCursorPosition(a,
                        "pageX") - this.s.mouse.startX, 2) + Math.pow(this._fnCursorPosition(a, "pageY") - this.s.mouse.startY, 2), .5)) return;
                this._fnCreateDragNode()
            }
            this.dom.drag.css({ left: this._fnCursorPosition(a, "pageX") - this.s.mouse.offsetX, top: this._fnCursorPosition(a, "pageY") - this.s.mouse.offsetY });
            var c = this.s.mouse.toIndex;
            a = this._fnCursorPosition(a, "pageX");
            for (var d = function(a) { for (; 0 <= a;) { a--; if (0 >= a) return null; if (b.s.aoTargets[a + 1].x !== b.s.aoTargets[a].x) return b.s.aoTargets[a] } }, h = function() {
                    for (var a = 0; a < b.s.aoTargets.length -
                        1; a++)
                        if (b.s.aoTargets[a].x !== b.s.aoTargets[a + 1].x) return b.s.aoTargets[a]
                }, f = function() { for (var a = b.s.aoTargets.length - 1; 0 < a; a--)
                        if (b.s.aoTargets[a].x !== b.s.aoTargets[a - 1].x) return b.s.aoTargets[a] }, k = 1; k < this.s.aoTargets.length; k++) { var n = d(k);
                n || (n = h()); var q = n.x + (this.s.aoTargets[k].x - n.x) / 2; if (this._fnIsLtr()) { if (a < q) { var l = n; break } } else if (a > q) { l = n; break } }
            l ? (this.dom.pointer.css("left", l.x), this.s.mouse.toIndex = l.to) : (this.dom.pointer.css("left", f().x), this.s.mouse.toIndex = f().to);
            this.s.init.bRealtime &&
                c !== this.s.mouse.toIndex && (this.s.dt.oInstance.fnColReorder(this.s.mouse.fromIndex, this.s.mouse.toIndex), this.s.mouse.fromIndex = this.s.mouse.toIndex, "" === this.s.dt.oScroll.sX && "" === this.s.dt.oScroll.sY || this.s.dt.oInstance.fnAdjustColumnSizing(!1), this._fnRegions())
        },
        _fnMouseUp: function(a) {
            d(r).off(".ColReorder");
            null !== this.dom.drag && (this.dom.drag.remove(), this.dom.pointer.remove(), this.dom.drag = null, this.dom.pointer = null, this.s.dt.oInstance.fnColReorder(this.s.mouse.fromIndex, this.s.mouse.toIndex, !0), this._fnSetColumnIndexes(), "" === this.s.dt.oScroll.sX && "" === this.s.dt.oScroll.sY || this.s.dt.oInstance.fnAdjustColumnSizing(!1), this.s.dt.oInstance.oApi._fnSaveState(this.s.dt), null !== this.s.reorderCallback && this.s.reorderCallback.call(this))
        },
        _fnRegions: function() {
            var a = this.s.dt.aoColumns,
                b = this._fnIsLtr();
            this.s.aoTargets.splice(0, this.s.aoTargets.length);
            var c = d(this.s.dt.nTable).offset().left,
                g = [];
            d.each(a, function(a, f) {
                if (f.bVisible && "none" !== f.nTh.style.display) {
                    f = d(f.nTh);
                    var h = f.offset().left;
                    b && (h += f.outerWidth());
                    g.push({ index: a, bound: h });
                    c = h
                } else g.push({ index: a, bound: c })
            });
            var h = g[0];
            a = d(a[h.index].nTh).outerWidth();
            this.s.aoTargets.push({ to: 0, x: h.bound - a });
            for (h = 0; h < g.length; h++) { a = g[h]; var f = a.index;
                a.index < this.s.mouse.fromIndex && f++;
                this.s.aoTargets.push({ to: f, x: a.bound }) }
            0 !== this.s.fixedRight && this.s.aoTargets.splice(this.s.aoTargets.length - this.s.fixedRight);
            0 !== this.s.fixed && this.s.aoTargets.splice(0, this.s.fixed)
        },
        _fnCreateDragNode: function() {
            var a = "" !== this.s.dt.oScroll.sX ||
                "" !== this.s.dt.oScroll.sY,
                b = this.s.dt.aoColumns[this.s.mouse.targetIndex].nTh,
                c = b.parentNode,
                g = c.parentNode,
                h = g.parentNode,
                f = d(b).clone();
            this.dom.drag = d(h.cloneNode(!1)).addClass("DTCR_clonedTable").append(d(g.cloneNode(!1)).append(d(c.cloneNode(!1)).append(f[0]))).css({ position: "absolute", top: 0, left: 0, width: d(b).outerWidth(), height: d(b).outerHeight() }).appendTo("body");
            this.dom.pointer = d("<div></div>").addClass("DTCR_pointer").css({
                position: "absolute",
                top: a ? d("div.dataTables_scroll", this.s.dt.nTableWrapper).offset().top : d(this.s.dt.nTable).offset().top,
                height: a ? d("div.dataTables_scroll", this.s.dt.nTableWrapper).height() : d(this.s.dt.nTable).height()
            }).appendTo("body")
        },
        _fnSetColumnIndexes: function() { d.each(this.s.dt.aoColumns, function(a, b) { d(b.nTh).attr("data-column-index", a) }) },
        _fnCursorPosition: function(a, b) { return -1 !== a.type.indexOf("touch") ? a.originalEvent.touches[0][b] : a[b] },
        _fnIsLtr: function() { return "rtl" !== d(this.s.dt.nTable).css("direction") }
    });
    k.defaults = {
        aiOrder: null,
        bEnable: !0,
        bRealtime: !0,
        iFixedColumnsLeft: 0,
        iFixedColumnsRight: 0,
        fnReorderCallback: null
    };
    k.version = "1.5.2";
    d.fn.dataTable.ColReorder = k;
    d.fn.DataTable.ColReorder = k;
    "function" == typeof d.fn.dataTable && "function" == typeof d.fn.dataTableExt.fnVersionCheck && d.fn.dataTableExt.fnVersionCheck("1.10.8") ? d.fn.dataTableExt.aoFeatures.push({ fnInit: function(a) { var b = a.oInstance;
                a._colReorder ? b.oApi._fnLog(a, 1, "ColReorder attempted to initialise twice. Ignoring second") : (b = a.oInit, new k(a, b.colReorder || b.oColReorder || {})); return null }, cFeature: "R", sFeature: "ColReorder" }) :
        alert("Warning: ColReorder requires DataTables 1.10.8 or greater - www.datatables.net/download");
    d(r).on("preInit.dt.colReorder", function(a, b) { if ("dt" === a.namespace) { a = b.oInit.colReorder; var c = y.defaults.colReorder; if (a || c) c = d.extend({}, a, c), !1 !== a && new k(b, c) } });
    d.fn.dataTable.Api.register("colReorder.reset()", function() { return this.iterator("table", function(a) { a._colReorder.fnReset() }) });
    d.fn.dataTable.Api.register("colReorder.order()", function(a, b) {
        return a ? this.iterator("table", function(c) {
            c._colReorder.fnOrder(a,
                b)
        }) : this.context.length ? this.context[0]._colReorder.fnOrder() : null
    });
    d.fn.dataTable.Api.register("colReorder.transpose()", function(a, b) { return this.context.length && this.context[0]._colReorder ? this.context[0]._colReorder.fnTranspose(a, b) : a });
    d.fn.dataTable.Api.register("colReorder.move()", function(a, b, c, d) { this.context.length && (this.context[0]._colReorder.s.dt.oInstance.fnColReorder(a, b, c, d), this.context[0]._colReorder._fnSetColumnIndexes()); return this });
    d.fn.dataTable.Api.register("colReorder.enable()",
        function(a) { return this.iterator("table", function(b) { b._colReorder && b._colReorder.fnEnable(a) }) });
    d.fn.dataTable.Api.register("colReorder.disable()", function() { return this.iterator("table", function(a) { a._colReorder && a._colReorder.fnDisable() }) });
    return k
});