
// const site_url = "http://127.0.0.1:8000/";
// let delayTimer;
// let currentRequest;
// let previousSearchText = ""; // Variable to store the previous search text

// // Document click event listener
// $(document).on('click', function(event) {
//   const target = event.target;
//   const searchBox = $("#SearchItems");
//   const searchResultContainer = $("#SearchItemShow");

//   // Check if the click target is outside the search box and search result container
//   if (!searchBox.is(target) && !searchResultContainer.is(target) && searchResultContainer.has(target).length === 0) {
//     // Clear the search box and remove the search results
//     searchBox.val("");
//     searchResultContainer.find('.panel__content').slideUp(300, function() {
//       $(this).remove();
//     });
//     searchResultContainer.css({
//       'max-height': 'none',
//       'overflow-y': 'visible'
//     });
//     previousSearchText = ""; // Clear the previous search text
//   }
// });

// // Search box focus event listener
// $("body").on("focus", "#SearchItems", function() {
//   const searchResultContainer = $("#SearchItemShow");

//   // Show the search results if there are any
//   if (searchResultContainer.find('.panel__content').length > 0) {
//     searchResultContainer.find('.panel__content').slideDown(300);
//   }
// });

// // Search box keyup event listener
// $("body").on("keyup", "#SearchItems", function() {
//   let text = $("#SearchItems").val();
//   const searchResultContainer = $("#SearchItemShow");

//   if (text.length > 0) {
//     clearTimeout(delayTimer);

//     delayTimer = setTimeout(function() {
//       if (currentRequest && currentRequest.readyState !== 4) {
//         currentRequest.abort();
//       }

//       if (previousSearchText.startsWith(text)) {
//         // If the previous search text starts with the new search text,
//         // skip the re-rendering process
//         return;
//       }

//       $.ajaxSetup({
//         headers: {
//           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//       });

//       currentRequest = $.ajax({
//         data: { search: text },
//         url: site_url + "search-product",
//         method: 'post',

//         success: function(result) {
//           var domain = window.location.href;
//           var data = '';

//           $.each(result.products, function(key, val) {
//             data += `
//               <div class="panel__content" style="display: none;">
//                 <div class="row py-2 mx-0">
//                   <div class="col-12 px-1 px-md-2 py-1 product-cart-wrap border-0 rounded-0">
//                     <div class="row mx-md-2 gx-md-2 gx-1">
//                       <div class="col-xl-2 col-3 product-img-action-wrap mb-0">
//                         <div class="product-img product-img-zoom">
//                           <a href="${domain}product/details/${val.id}/${val.product_slug}">
//                             <img class="default-img" src="${domain + val.product_thumbnail}" alt="Seeds of Change Organic Quinoe (Digital)">
//                           </a>
//                         </div>
//                       </div>
//                       <div class="col-xl-10 col-9 product__content">
//                         <div class="product-content-wrap px-1 px-md-3">
//                           <a class="product__title" href="${domain}product/details/${val.id}/${val.product_slug}">${val.product_name}</a>
//                           <div class="product-price">
//                             <span>$${val.selling_price}</span>
//                           </div>
//                         </div>
//                       </div>
//                     </div>
//                   </div>
//                 </div>
//               </div>
//             `;
//           });

//           // Remove previous search results
//           searchResultContainer.find('.panel__content').slideUp(300, function() {
//             $(this).remove();
//           });

//           // Append and show the new search results
//           searchResultContainer.append(data);
//           searchResultContainer.find('.panel__content').slideDown(300);

//           previousSearchText = text; // Update the previous search text

//           // Add scroll behavior if more than 5 items
//           if (result.products.length > 5) {
//             searchResultContainer.css({
//               'max-height': '550px',
//               'overflow-y': 'scroll'
//             });
//           } else {
//             searchResultContainer.css({
//               'max-height': 'none',
//               'overflow-y': 'visible'
//             });
//           }
//         }
//       });
//     }, 500);
//   } else {
//     clearTimeout(delayTimer);
//     searchResultContainer.find('.panel__content').slideUp(300, function() {
//       $(this).remove();
//     });
//     searchResultContainer.css({
//       'max-height': 'none',
//       'overflow-y': 'visible'
//     });
//     previousSearchText = ""; // Clear the previous search text
//   }
// });

















const site_url = "http://127.0.0.1:8000/";
let delayTimer;
let currentRequest;
let previousSearchText = ""; // Variable to store the previous search text

// Document click event listener
$(document).on('click', function(event) {
  const target = event.target;
  const searchBox = $("#SearchItems");
  const searchResultContainer = $("#SearchItemShow");

  // Check if the click target is outside the search box and search result container
  if (!searchBox.is(target) && !searchResultContainer.is(target) && searchResultContainer.has(target).length === 0) {
    // Clear the search box and remove the search results
    searchBox.val("");
    searchResultContainer.find('.panel__content').slideUp(300, function() {
      $(this).remove();
    });
    searchResultContainer.removeClass('active'); // Remove the "active" class
    searchResultContainer.css({
      'max-height': 'none',
      'overflow-y': 'visible'
    });
    previousSearchText = ""; // Clear the previous search text
  }
});

// Search box focus event listener
$("body").on("focus", "#SearchItems", function() {
  const searchResultContainer = $("#SearchItemShow");

  // Show the search results if there are any
  if (searchResultContainer.find('.panel__content').length > 0) {
    searchResultContainer.find('.panel__content').slideDown(300);
    searchResultContainer.addClass('active'); // Add the "active" class
  }
});

// Search box keyup event listener
$("body").on("keyup", "#SearchItems", function() {
  let text = $("#SearchItems").val();
  const searchResultContainer = $("#SearchItemShow");

  if (text.length > 0) {
    clearTimeout(delayTimer);

    delayTimer = setTimeout(function() {
      if (currentRequest && currentRequest.readyState !== 4) {
        currentRequest.abort();
      }

      if (previousSearchText.startsWith(text)) {
        // If the previous search text starts with the new search text,
        // skip the re-rendering process
        return;
      }

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      currentRequest = $.ajax({
        data: { search: text },
        url: site_url + "search-product",
        method: 'post',

        success: function(result) {
          var domain = window.location.href;
          var data = '';

          $.each(result.products, function(key, val) {
            data += `
              <div class="panel__content" style="display: none;">
                <div class="row py-2 mx-0">
                  <div class="col-12 px-1 px-md-2 py-1 product-cart-wrap border-0 rounded-0">
                    <div class="row mx-md-2 gx-md-2 gx-1">
                      <div class="col-xl-2 col-3 product-img-action-wrap mb-0">
                        <div class="product-img product-img-zoom">
                          <a href="${domain}product/details/${val.id}/${val.product_slug}">
                            <img class="default-img" src="${domain + val.product_thumbnail}" alt="Seeds of Change Organic Quinoe (Digital)">
                          </a>
                        </div>
                      </div>
                      <div class="col-xl-10 col-9 product__content">
                        <div class="product-content-wrap px-1 px-md-3">
                          <a class="product__title" href="${domain}product/details/${val.id}/${val.product_slug}">${val.product_name}</a>
                          <div class="product-price">
                            <span>$${val.selling_price}</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            `;
          });

          // Remove previous search results
          searchResultContainer.find('.panel__content').slideUp(300, function() {
            $(this).remove();
          });

          // Append and show the new search results
          searchResultContainer.append(data);
          searchResultContainer.find('.panel__content').slideDown(300);
          searchResultContainer.addClass('active'); // Add the "active" class

          previousSearchText = text; // Update the previous search text

          // Add scroll behavior if more than 5 items
          if (result.products.length > 5) {
            searchResultContainer.css({
              'max-height': '550px',
              'overflow-y': 'scroll'
            });
          } else {
            searchResultContainer.css({
              'max-height': 'none',
              'overflow-y': 'visible'
            });
          }
        }
      });
    }, 500);
  } else {
    clearTimeout(delayTimer);
    searchResultContainer.find('.panel__content').slideUp(300, function() {
      $(this).remove();
    });
    searchResultContainer.removeClass('active'); // Remove the "active" class
    searchResultContainer.css({
      'max-height': 'none',
      'overflow-y': 'visible'
    });
    previousSearchText = ""; // Clear the previous search text
  }
});
