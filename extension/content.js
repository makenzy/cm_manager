document.addEventListener("hello", function(data) {
    chrome.runtime.sendMessage("test");
});

// chrome.runtime.onMessageExternal.addListener(
//   function(request, sender, sendResponse) {
//     if (sender.url == blacklistedWebsite)
//       return;  // don't allow this web page access
//     if (request.openUrlInEditor)
//       openUrl(request.openUrlInEditor);
//   });