$().ready(function() {
  var drawing = document.getElementById("stats");
    if(drawing.getContext) {
            var context = drawing.getContext("2d");
    }
    context.translate(0, 400);

    function minA(arr) {
      var length = arr.length;
      var min = arr[0];
      while(length > 1) {
        if(arr[length] < min) {
          min = arr[length];
        }
        length--;
      }
      return min;}
    function maxA(arr) {
      var length = arr.length;
      var max = arr[0];
      while(length > 1) {
        if(arr[length] > max) {
          max = arr[length];
        }
        length--;
      }
      return max;}
    function line() {
            var k = 0;
            context.beginPath();
            while(k <= 960) {
                  context.moveTo(k, 0);
                  context.lineTo(k, -400);
                  k = k + 40;
            }
            context.strokeStyle = "#bfbfbf";
            context.lineWidth = 1;
            context.stroke();}
    function Graph(points, colorline, wid) {
            var len = points.length;
            var i, l = 0;
            context.beginPath();
            context.moveTo(0, points[0]);
            i = 1;
            l += 40;
            while(i < len) {
                 context.lineTo(l, points[i]);
                 i++;
                 l = l + 40;
           }
           context.strokeStyle = colorline;
           context.lineWidth = wid;
           context.stroke();}
    function circyl(points) {
            var c = 0, i = 0;
            var len = points.length;
            while(i < len) {
                  context.beginPath();
                  context.arc(c, points[i], 4, 0, 2 * Math.PI, false);
                  context.strokeStyle = '#efefef';
                  context.stroke();
                  context.fillStyle = "rgba(255,179,0, 1)";
                  context.fill();
                  c = c + 40;
                  i++;
            }}
    function punct(arr, x) {
      context.beginPath();
      var k = 10;
      while(k < 920) {
        context.moveTo(k, x);
        context.lineTo(k + 20, x);
        k += 40;
      }
      context.strokeStyle = "#fff";
      context.lineWidth = 2;
      context.stroke();
    }

    var stats = new Array(-80, -100,  -100, -160, -80, -80, -140, -50, -120, -100, -50, -220, -280, -50, -260, -200, -180, -180, -200, -160, -50, -100, -120, -140);
    line();
    Graph(stats, 'rgba(255,179,0, 1)', 3);
    punct(stats, minA(stats));
    punct(stats, maxA(stats));
    circyl(stats);
    var drawing = document.getElementById("stats_two");
    if(drawing.getContext) {
            var context2 = drawing.getContext("2d");
    }
});  