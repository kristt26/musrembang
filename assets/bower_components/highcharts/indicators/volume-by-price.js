/*
 Highstock JS v8.2.0 (2020-08-20)

 Indicator series type for Highstock

 (c) 2010-2019 Pawe Dalek

 License: www.highcharts.com/license
*/
(function(c){"object"===typeof module&&module.exports?(c["default"]=c,module.exports=c):"function"===typeof define&&define.amd?define("highcharts/indicators/volume-by-price",["highcharts","highcharts/modules/stock"],function(p){c(p);c.Highcharts=p;return c}):c("undefined"!==typeof Highcharts?Highcharts:void 0)})(function(c){function p(c,p,m,t){c.hasOwnProperty(p)||(c[p]=t.apply(null,m))}c=c?c._modules:{};p(c,"Stock/Indicators/VBPIndicator.js",[c["Core/Globals.js"],c["Core/Series/Point.js"],c["Core/Utilities.js"]],
function(c,p,m){var t=m.addEvent,D=m.animObject,A=m.arrayMax,E=m.arrayMin,y=m.correctFloat,z=m.error,F=m.extend,G=m.isArray;m=m.seriesType;var u=Math.abs,B=c.noop,x=c.seriesTypes.column.prototype;m("vbp","sma",{params:{ranges:12,volumeSeriesID:"volume"},zoneLines:{enabled:!0,styles:{color:"#0A9AC9",dashStyle:"LongDash",lineWidth:1}},volumeDivision:{enabled:!0,styles:{positiveColor:"rgba(144, 237, 125, 0.8)",negativeColor:"rgba(244, 91, 91, 0.8)"}},animationLimit:1E3,enableMouseTracking:!1,pointPadding:0,
zIndex:-1,crisp:!0,dataGrouping:{enabled:!1},dataLabels:{allowOverlap:!0,enabled:!0,format:"P: {point.volumePos:.2f} | N: {point.volumeNeg:.2f}",padding:0,style:{fontSize:"7px"},verticalAlign:"top"}},{nameBase:"Volume by Price",bindTo:{series:!1,eventName:"afterSetExtremes"},calculateOn:"render",markerAttribs:B,drawGraph:B,getColumnMetrics:x.getColumnMetrics,crispCol:x.crispCol,init:function(d){c.seriesTypes.sma.prototype.init.apply(this,arguments);var a=this.options.params;var f=this.linkedParent;
a=d.get(a.volumeSeriesID);this.addCustomEvents(f,a);return this},addCustomEvents:function(d,a){function f(){b.chart.redraw();b.setData([]);b.zoneStarts=[];b.zoneLinesSVG&&(b.zoneLinesSVG.destroy(),delete b.zoneLinesSVG)}var b=this;b.dataEventsToUnbind.push(t(d,"remove",function(){f()}));a&&b.dataEventsToUnbind.push(t(a,"remove",function(){f()}));return b},animate:function(d){var a=this,f=a.chart.inverted,b=a.group,n={};!d&&b&&(d=f?"translateY":"translateX",f=f?a.yAxis.top:a.xAxis.left,b["forceAnimate:"+
d]=!0,n[d]=f,b.animate(n,F(D(a.options.animation),{step:function(d,b){a.group.attr({scaleX:Math.max(.001,b.pos)})}})))},drawPoints:function(){this.options.volumeDivision.enabled&&(this.posNegVolume(!0,!0),x.drawPoints.apply(this,arguments),this.posNegVolume(!1,!1));x.drawPoints.apply(this,arguments)},posNegVolume:function(d,a){var f=a?["positive","negative"]:["negative","positive"],b=this.options.volumeDivision,n=this.points.length,l=[],e=[],h=0,k;d?(this.posWidths=l,this.negWidths=e):(l=this.posWidths,
e=this.negWidths);for(;h<n;h++){var g=this.points[h];g[f[0]+"Graphic"]=g.graphic;g.graphic=g[f[1]+"Graphic"];if(d){var c=g.shapeArgs.width;var v=this.priceZones[h];(k=v.wholeVolumeData)?(l.push(c/k*v.positiveVolumeData),e.push(c/k*v.negativeVolumeData)):(l.push(0),e.push(0))}g.color=a?b.styles.positiveColor:b.styles.negativeColor;g.shapeArgs.width=a?this.posWidths[h]:this.negWidths[h];g.shapeArgs.x=a?g.shapeArgs.x:this.posWidths[h]}},translate:function(){var d=this,a=d.options,f=d.chart,b=d.yAxis,
n=b.min,c=d.options.zoneLines,e=d.priceZones,h=0,k,g,C;x.translate.apply(d);var v=d.points;if(v.length){var m=.5>a.pointPadding?a.pointPadding:.1;a=d.volumeDataArray;var p=A(a);var q=f.plotWidth/2;var H=f.plotTop;var w=u(b.toPixels(n)-b.toPixels(n+d.rangeStep));var t=u(b.toPixels(n)-b.toPixels(n+d.rangeStep));m&&(n=u(w*(1-2*m)),h=u((w-n)/2),w=u(n));v.forEach(function(a,f){g=a.barX=a.plotX=0;C=a.plotY=b.toPixels(e[f].start)-H-(b.reversed?w-t:w)-h;k=y(q*e[f].wholeVolumeData/p);a.pointWidth=k;a.shapeArgs=
d.crispCol.apply(d,[g,C,k,w]);a.volumeNeg=e[f].negativeVolumeData;a.volumePos=e[f].positiveVolumeData;a.volumeAll=e[f].wholeVolumeData});c.enabled&&d.drawZones(f,b,d.zoneStarts,c.styles)}},getValues:function(d,a){var f=d.processedXData,b=d.processedYData,c=this.chart,l=a.ranges,e=[],h=[],k=[],g;if(d.chart)if(g=c.get(a.volumeSeriesID))if((a=G(b[0]))&&4!==b[0].length)z("Type of "+d.name+" series is different than line, OHLC or candlestick.",!0,c);else return(this.priceZones=this.specifyZones(a,f,b,
l,g)).forEach(function(a,b){e.push([a.x,a.end]);h.push(e[b][0]);k.push(e[b][1])}),{values:e,xData:h,yData:k};else z("Series "+a.volumeSeriesID+" not found! Check `volumeSeriesID`.",!0,c);else z("Base series not found! In case it has been removed, add a new one.",!0,c)},specifyZones:function(d,a,f,b,c){if(d){var l=f.length;for(var e=f[0][3],h=e,k=1,g;k<l;k++)g=f[k][3],g<e&&(e=g),g>h&&(h=g);l={min:e,max:h}}else l=!1;l=(e=l)?e.min:E(f);g=e?e.max:A(f);e=this.zoneStarts=[];h=[];var n=0;k=1;if(!l||!g)return this.points.length&&
(this.setData([]),this.zoneStarts=[],this.zoneLinesSVG.destroy()),[];var m=this.rangeStep=y(g-l)/b;for(e.push(l);n<b-1;n++)e.push(y(e[n]+m));e.push(g);for(b=e.length;k<b;k++)h.push({index:k-1,x:a[0],start:e[k-1],end:e[k]});return this.volumePerZone(d,h,c,a,f)},volumePerZone:function(d,a,f,b,c){var l=this,e=f.processedXData,h=f.processedYData,k=a.length-1,g=c.length;f=h.length;var m,n,p,r,q;u(g-f)&&(b[0]!==e[0]&&h.unshift(0),b[g-1]!==e[f-1]&&h.push(0));l.volumeDataArray=[];a.forEach(function(a){a.wholeVolumeData=
0;a.positiveVolumeData=0;for(q=a.negativeVolumeData=0;q<g;q++)p=n=!1,r=d?c[q][3]:c[q],m=q?d?c[q-1][3]:c[q-1]:r,r<=a.start&&0===a.index&&(n=!0),r>=a.end&&a.index===k&&(p=!0),(r>a.start||n)&&(r<a.end||p)&&(a.wholeVolumeData+=h[q],m>r?a.negativeVolumeData+=h[q]:a.positiveVolumeData+=h[q]);l.volumeDataArray.push(a.wholeVolumeData)});return a},drawZones:function(d,a,c,b){var f=d.renderer,l=this.zoneLinesSVG,e=[],h=d.plotWidth,k=d.plotTop,g;c.forEach(function(c){g=a.toPixels(c)-k;e=e.concat(d.renderer.crispLine([["M",
0,g],["L",h,g]],b.lineWidth))});l?l.animate({d:e}):l=this.zoneLinesSVG=f.path(e).attr({"stroke-width":b.lineWidth,stroke:b.color,dashstyle:b.dashStyle,zIndex:this.group.zIndex+.1}).add(this.group)}},{destroy:function(){this.negativeGraphic&&(this.negativeGraphic=this.negativeGraphic.destroy());return p.prototype.destroy.apply(this,arguments)}});""});p(c,"masters/indicators/volume-by-price.src.js",[],function(){})});
//# sourceMappingURL=volume-by-price.js.map