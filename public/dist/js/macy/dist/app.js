var endpoint = "";
var elem = document.querySelector(".gallery");
var infiniteScroll = new InfiniteScroll(elem, {
  path: endpoint + "?page=@{{#}}",
  status: ".page-load-status",
  history: false,
  append: ".images",
  scrollThreshold: 100,
  // debug: true, // Optional: Enable debugging messages
});

infiniteScroll.on("append", function (body, path, items, response) {
  msnry.runOnImageLoad(function () {
    msnry.recalculate(true);
  }, true);
});

const msnry = new Macy({
  container: ".gallery",
  mobileFirst: true,
  columns: 1,
  breakAt: {
    200: 2,
    700: 4,
    1100: 4,
  },
  margin: {
    x: 8,
    y: 8,
  },
});
