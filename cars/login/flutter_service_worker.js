'use strict';
const MANIFEST = 'flutter-app-manifest';
const TEMP = 'flutter-temp-cache';
const CACHE_NAME = 'flutter-app-cache';
const RESOURCES = {
  "version.json": "34290cb5af4ac40f84163a1f55722ffb",
"index.html": "944761924603797787e6221e1d83c61d",
"/": "944761924603797787e6221e1d83c61d",
"main.dart.js": "f927d15ff7fda3db924129873b891f63",
"favicon.png": "5dcef449791fa27946b3d35ad8803796",
"icons/Icon-192.png": "ac9a721a12bbc803b44f645561ecb1e1",
"icons/Icon-512.png": "96e752610906ba2a93c65f8abe1645f1",
"manifest.json": "3f20c481d9878c42c2d7811df88edfd4",
"assets/AssetManifest.json": "de0cc37b70e073758454c10caf0b1ad6",
"assets/NOTICES": "cec2ba298b04a66f6985571e58ec84ac",
"assets/FontManifest.json": "4784e0a2803f345052a3d24f5217484b",
"assets/packages/cupertino_icons/assets/CupertinoIcons.ttf": "6d342eb68f170c97609e9da345464e5e",
"assets/packages/fluttertoast/assets/toastify.js": "8f5ac78dd0b9b5c9959ea1ade77f68ae",
"assets/packages/fluttertoast/assets/toastify.css": "8beb4c67569fb90146861e66d94163d7",
"assets/i18n/en.json": "bc0fd0baf44a41fa1e1ae92b4061a792",
"assets/i18n/ar.json": "bc0fd0baf44a41fa1e1ae92b4061a792",
"assets/fonts/ge_dinar.otf": "c63fa6964acf040193f8fc55b79eb761",
"assets/fonts/vipes.ttf": "b6964a5be0b8c372ce8bd987f1d27aac",
"assets/fonts/MaterialIcons-Regular.otf": "1288c9e28052e028aba623321f7826ac",
"assets/assets/car1.jpg": "7a46ae76db1c3b431242fa107d1066b5",
"assets/assets/icon.png": "1ef21e56c2b1ba7393bb9010de74bc42",
"assets/assets/body_background.jpg": "cc9fd2e9c8f6a317c9ebdcd4769e7744",
"assets/assets/000.png": "d0f8b71ef886719ec35c7662c2e9b980",
"assets/assets/saudi_logo.jpg": "f020ca153ff2a28ad32c8bf6d668b646",
"assets/assets/mad1.jpeg": "0b0ee51dd5b887de239745797cfbbc5c",
"assets/assets/2030_1.jpeg": "f78d0110f6b096c317a23694849509b9",
"assets/assets/instagram.png": "f0191d90834b266cc06dc4c0deee80e3",
"assets/assets/winch.jpg": "0304bd63bf71a2772a222827a81ddaae",
"assets/assets/king_3.jpeg": "abcf2923f12c5493e693d4ef1087e982",
"assets/assets/king_2.jpeg": "93e31e96b79892567e774217b15013cc",
"assets/assets/pic1.jpg": "2ea52fe0cc50576b23f245233b376462",
"assets/assets/pic3.jpg": "1d7b475868d74b46510f67efea57b6aa",
"assets/assets/pic2.jpg": "b178d4fd34e3370620cb70c3236af53b",
"assets/assets/logo2.jpg": "7c08660fb886f7388b1797db93609e7f",
"assets/assets/king_1.jpeg": "71276914b79f2fb5ff9552c574a88d79",
"assets/assets/logo.png": "03bcf20d2ac1c00ebf0d9d6135eeb477",
"assets/assets/mad_3.jpg": "165c1645c40d6e432710efd5ca020ba3",
"assets/assets/logonew.jpg": "8af4904eae6207f7237b7165616dbfd0",
"assets/assets/logo_masdar.png": "491090b637480d593980b2a6901e5ef2",
"assets/assets/twitter.png": "7355467cdd7b7f7ed4bd84a3120f8920",
"assets/assets/mad_4.jpg": "837f80a3050607736444619482c33ed0",
"assets/assets/img_2030.png": "9630827e06297a3817e45596585aba5a",
"assets/assets/2030_2.jpeg": "5779df821f9d136625f1d01b0262d3ed",
"assets/assets/img2_2030.png": "dd07e3f6d040afa75d9039075b157b04",
"assets/assets/mad2.jpeg": "e9f8bf89ff738e70b55d34f30f2e11db",
"assets/assets/facebook.png": "3891e938581aee3d27a438ace5198ce4",
"assets/assets/logon.jpeg": "70f852a9722408486022bbc845abca78",
"assets/assets/car2.jpeg": "cb21f3884cb25f5172fd209000e54874",
"assets/assets/2030_3.jpeg": "38929ee680b7ba7c0c2505fdec0b6dc5"
};

// The application shell files that are downloaded before a service worker can
// start.
const CORE = [
  "/",
"main.dart.js",
"index.html",
"assets/NOTICES",
"assets/AssetManifest.json",
"assets/FontManifest.json"];
// During install, the TEMP cache is populated with the application shell files.
self.addEventListener("install", (event) => {
  self.skipWaiting();
  return event.waitUntil(
    caches.open(TEMP).then((cache) => {
      return cache.addAll(
        CORE.map((value) => new Request(value + '?revision=' + RESOURCES[value], {'cache': 'reload'})));
    })
  );
});

// During activate, the cache is populated with the temp files downloaded in
// install. If this service worker is upgrading from one with a saved
// MANIFEST, then use this to retain unchanged resource files.
self.addEventListener("activate", function(event) {
  return event.waitUntil(async function() {
    try {
      var contentCache = await caches.open(CACHE_NAME);
      var tempCache = await caches.open(TEMP);
      var manifestCache = await caches.open(MANIFEST);
      var manifest = await manifestCache.match('manifest');
      // When there is no prior manifest, clear the entire cache.
      if (!manifest) {
        await caches.delete(CACHE_NAME);
        contentCache = await caches.open(CACHE_NAME);
        for (var request of await tempCache.keys()) {
          var response = await tempCache.match(request);
          await contentCache.put(request, response);
        }
        await caches.delete(TEMP);
        // Save the manifest to make future upgrades efficient.
        await manifestCache.put('manifest', new Response(JSON.stringify(RESOURCES)));
        return;
      }
      var oldManifest = await manifest.json();
      var origin = self.location.origin;
      for (var request of await contentCache.keys()) {
        var key = request.url.substring(origin.length + 1);
        if (key == "") {
          key = "/";
        }
        // If a resource from the old manifest is not in the new cache, or if
        // the MD5 sum has changed, delete it. Otherwise the resource is left
        // in the cache and can be reused by the new service worker.
        if (!RESOURCES[key] || RESOURCES[key] != oldManifest[key]) {
          await contentCache.delete(request);
        }
      }
      // Populate the cache with the app shell TEMP files, potentially overwriting
      // cache files preserved above.
      for (var request of await tempCache.keys()) {
        var response = await tempCache.match(request);
        await contentCache.put(request, response);
      }
      await caches.delete(TEMP);
      // Save the manifest to make future upgrades efficient.
      await manifestCache.put('manifest', new Response(JSON.stringify(RESOURCES)));
      return;
    } catch (err) {
      // On an unhandled exception the state of the cache cannot be guaranteed.
      console.error('Failed to upgrade service worker: ' + err);
      await caches.delete(CACHE_NAME);
      await caches.delete(TEMP);
      await caches.delete(MANIFEST);
    }
  }());
});

// The fetch handler redirects requests for RESOURCE files to the service
// worker cache.
self.addEventListener("fetch", (event) => {
  if (event.request.method !== 'GET') {
    return;
  }
  var origin = self.location.origin;
  var key = event.request.url.substring(origin.length + 1);
  // Redirect URLs to the index.html
  if (key.indexOf('?v=') != -1) {
    key = key.split('?v=')[0];
  }
  if (event.request.url == origin || event.request.url.startsWith(origin + '/#') || key == '') {
    key = '/';
  }
  // If the URL is not the RESOURCE list then return to signal that the
  // browser should take over.
  if (!RESOURCES[key]) {
    return;
  }
  // If the URL is the index.html, perform an online-first request.
  if (key == '/') {
    return onlineFirst(event);
  }
  event.respondWith(caches.open(CACHE_NAME)
    .then((cache) =>  {
      return cache.match(event.request).then((response) => {
        // Either respond with the cached resource, or perform a fetch and
        // lazily populate the cache.
        return response || fetch(event.request).then((response) => {
          cache.put(event.request, response.clone());
          return response;
        });
      })
    })
  );
});

self.addEventListener('message', (event) => {
  // SkipWaiting can be used to immediately activate a waiting service worker.
  // This will also require a page refresh triggered by the main worker.
  if (event.data === 'skipWaiting') {
    self.skipWaiting();
    return;
  }
  if (event.data === 'downloadOffline') {
    downloadOffline();
    return;
  }
});

// Download offline will check the RESOURCES for all files not in the cache
// and populate them.
async function downloadOffline() {
  var resources = [];
  var contentCache = await caches.open(CACHE_NAME);
  var currentContent = {};
  for (var request of await contentCache.keys()) {
    var key = request.url.substring(origin.length + 1);
    if (key == "") {
      key = "/";
    }
    currentContent[key] = true;
  }
  for (var resourceKey of Object.keys(RESOURCES)) {
    if (!currentContent[resourceKey]) {
      resources.push(resourceKey);
    }
  }
  return contentCache.addAll(resources);
}

// Attempt to download the resource online before falling back to
// the offline cache.
function onlineFirst(event) {
  return event.respondWith(
    fetch(event.request).then((response) => {
      return caches.open(CACHE_NAME).then((cache) => {
        cache.put(event.request, response.clone());
        return response;
      });
    }).catch((error) => {
      return caches.open(CACHE_NAME).then((cache) => {
        return cache.match(event.request).then((response) => {
          if (response != null) {
            return response;
          }
          throw error;
        });
      });
    })
  );
}
