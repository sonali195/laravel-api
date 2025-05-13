<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ Helper::assets('assets/js/vendor.min.js') }}"></script>
@yield('script')
<script type="text/javascript"> var assetUrl="{{ Helper::assets('assets/') }}"; </script>
<script src="{{ Helper::assets('assets/js/app.min.js') }}"></script>
<script src="{{ Helper::assets('assets/js/custom.js') }}"></script>


@yield('script-bottom')
@if(isset($schedules) && $schedules)
<script defer type="text/javascript">
     $(document).ready(function() {
        // Ensure that the schedules variable is available
        const schedules = @json($schedules);
        function displayAyahs(surahId) {
    const surah = schedules.find(s => s.id == surahId);
    const container = $('#ayahContainer');

    if (surah && surah.ayats.length > 0) {
        let html = `<div class="accordion" id="ayahAccordion">`;
        surah.ayats.forEach((ayah, index) => {
            const collapseId = `collapse${surah.id}-${index}`;
            const headingId = `heading${surah.id}-${index}`;
            html += `
                <div class="accordion-item">
                    <h2 class="accordion-header" id="${headingId}">
                        <button class="accordion-button collapsed justify-content-end" type="button" data-bs-toggle="collapse" data-bs-target="#${collapseId}" aria-expanded="false" aria-controls="${collapseId}">
                           <span class="index" style="float: left;width: 206%;color:#000;"> <strong>Ayah ${index + 1}: </strong></span><span class="title" style="color:green;float: right;width: 31%;"> ${ayah.title_ar}</span>
                        </button>
                    </h2>
                    <div id="${collapseId}" class="accordion-collapse collapse" aria-labelledby="${headingId}" data-bs-parent="#ayahAccordion">
                        <div class="accordion-body">
                            <p><strong>Translation:</strong> ${ayah.title_translation}</p>
                            <p><strong>Transliteration:</strong> ${ayah.title_transliteration}</p>
                        </div>
                    </div>
                </div>
            `;
        });
        html += `</div>`;
        container.html(html);
    } else {
        container.html('<p class="text-muted mt-3">No Ayahs available for this Surah.</p>');
    }
}


        // Bind change event to Surah select dropdown
        $('#surahSelect').on('change', function() {
            const selectedId = $(this).val();
            if (selectedId) {
                displayAyahs(selectedId);
            } else {
                $('#ayahContainer').empty();
            }
        });

        // Optional: Trigger change event on tab activation
        $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
            const target = $(e.target).attr("href"); // activated tab
            if (target === '#ayah') {
                const selectedId = $('#surahSelect').val();
                if (selectedId) {
                    displayAyahs(selectedId);
                }
            }
        });
    });
    // Browser notification
    // document.addEventListener('DOMContentLoaded', function() {
    //     if (Notification.permission !== "granted") {
    //         Notification.requestPermission();
    //     }

    //     notifyBrowser("Hello Word", "How are you?");
    // });
    
    // function notifyBrowser(title, desc) {
    //     if (!Notification) {
    //         console.log('Desktop notifications not available in your browser..');
    //         return;
    //     }
    //     if (Notification.permission !== "granted") {
    //         Notification.requestPermission();
    //     } else {
    //         var notification = new Notification(title, {
    //             icon: assetUrl + '/images/logo.png',
    //             body: desc,
    //         });
    //     }
    // }
</script>
@endif
@if(isset($notificationjs) && $notificationjs)
<script defer type="text/javascript">    
    var get_notification_link = "{{ route('user.notifications') }}";
</script>
<script defer src="{{ Helper::assets('assets/js/pages/notification.js') }}"></script>
@endif