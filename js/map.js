/**
 * Expreso a Oriente - Leaflet Map
 * Cities visited during the journey
 */

document.addEventListener('DOMContentLoaded', function () {
    var mapEl = document.getElementById('cities-map');
    if (!mapEl) return;

    var map = L.map('cities-map', {
        scrollWheelZoom: false
    }).setView([35, 50], 3);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        maxZoom: 18
    }).addTo(map);

    // Cities with coordinates, chapter reference, and slugs
    var cities = [
        { name: 'Frankfurt', lat: 50.1109, lng: 8.6821, chapter: '1', slug_es: 'occupy-frankfurt', slug_en: 'occupy-frankfurt' },
        { name: 'Berlin', lat: 52.5200, lng: 13.4050, chapter: '2', slug_es: 'becoming-berlin', slug_en: 'becoming-berlin' },
        { name: 'Varsovia / Warsaw', lat: 52.2297, lng: 21.0122, chapter: '3', slug_es: 'desprejuicios', slug_en: 'three-versions-of-poland' },
        { name: 'Cracovia / Krakow', lat: 50.0647, lng: 19.9450, chapter: '3', slug_es: 'desprejuicios', slug_en: 'three-versions-of-poland' },
        { name: 'Vilna / Vilnius', lat: 54.6872, lng: 25.2797, chapter: '4', slug_es: 'los-balticos', slug_en: 'the-baltics' },
        { name: 'Riga', lat: 56.9496, lng: 24.1052, chapter: '4', slug_es: 'los-balticos', slug_en: 'the-baltics' },
        { name: 'Tallin / Tallinn', lat: 59.4370, lng: 24.7536, chapter: '4', slug_es: 'los-balticos', slug_en: 'the-baltics' },
        { name: 'San Petersburgo / St. Petersburg', lat: 59.9311, lng: 30.3609, chapter: '5', slug_es: 'la-dacha', slug_en: 'the-dacha' },
        { name: 'Moscú / Moscow', lat: 55.7558, lng: 37.6173, chapter: '6', slug_es: 'rusia', slug_en: 'russia' },
        { name: 'Ekaterimburgo / Yekaterinburg', lat: 56.8389, lng: 60.6057, chapter: '7', slug_es: 'los-romanov', slug_en: 'the-romanovs' },
        { name: 'Novosibirsk', lat: 55.0084, lng: 82.9357, chapter: '8', slug_es: 'los-pascal-jenny', slug_en: 'the-pascal-jenny' },
        { name: 'Irkutsk', lat: 52.2870, lng: 104.3050, chapter: '8', slug_es: 'los-pascal-jenny', slug_en: 'the-pascal-jenny' },
        { name: 'Ulán Bator / Ulaanbaatar', lat: 47.8864, lng: 106.9057, chapter: '9', slug_es: 'mongolia-primera-parte', slug_en: 'mongolia-part-one' },
        { name: 'Beijing', lat: 39.9042, lng: 116.4074, chapter: '11', slug_es: 'china', slug_en: 'china' },
        { name: 'Shanghai', lat: 31.2304, lng: 121.4737, chapter: '11', slug_es: 'china', slug_en: 'china' },
        { name: 'Hong Kong', lat: 22.3193, lng: 114.1694, chapter: '11', slug_es: 'china', slug_en: 'china' },
        { name: 'Yangón / Yangon', lat: 16.8661, lng: 96.1951, chapter: '12', slug_es: 'myanmar', slug_en: 'myanmar' },
        { name: 'Bagán / Bagan', lat: 21.1717, lng: 94.8585, chapter: '12', slug_es: 'myanmar', slug_en: 'myanmar' },
        { name: 'Mandalay', lat: 21.9588, lng: 96.0891, chapter: '12', slug_es: 'myanmar', slug_en: 'myanmar' },
        { name: 'Kolkata', lat: 22.5726, lng: 88.3639, chapter: '13', slug_es: 'india', slug_en: 'india' },
        { name: 'Varanasi', lat: 25.3176, lng: 82.9739, chapter: '14', slug_es: 'varanasi', slug_en: 'varanasi' },
        { name: 'Goa', lat: 15.2993, lng: 74.1240, chapter: '13', slug_es: 'india', slug_en: 'india' },
        { name: 'Delhi', lat: 28.7041, lng: 77.1025, chapter: '13', slug_es: 'india', slug_en: 'india' },
        { name: 'Amman', lat: 31.9454, lng: 35.9284, chapter: '15', slug_es: 'medio-oriente', slug_en: 'middle-east' },
        { name: 'Jerusalén / Jerusalem', lat: 31.7683, lng: 35.2137, chapter: '15', slug_es: 'medio-oriente', slug_en: 'middle-east' },
        { name: 'Tel Aviv', lat: 32.0853, lng: 34.7818, chapter: '15', slug_es: 'medio-oriente', slug_en: 'middle-east' },
        { name: 'Sinaí / Sinai', lat: 28.5500, lng: 33.8000, chapter: '15', slug_es: 'medio-oriente', slug_en: 'middle-east' }
    ];

    // Custom marker style
    var markerIcon = L.divIcon({
        className: 'custom-marker',
        html: '<div style="width:12px;height:12px;background:#0a0a0a;border:2px solid #fff;border-radius:50%;box-shadow:0 1px 4px rgba(0,0,0,.3);"></div>',
        iconSize: [12, 12],
        iconAnchor: [6, 6],
        popupAnchor: [0, -8]
    });

    // Route polyline coordinates
    var routeCoords = cities.map(function (c) {
        return [c.lat, c.lng];
    });

    L.polyline(routeCoords, {
        color: '#0a0a0a',
        weight: 1.5,
        opacity: 0.4,
        dashArray: '6, 8'
    }).addTo(map);

    // Add markers
    var slugKey = 'slug_' + mapLang;
    cities.forEach(function (city) {
        var slug = city[slugKey] || city.slug_es;
        var chapterUrl = mapBasePath + '/' + mapLang + '/' + mapChapterPrefix + '/' + slug;
        var popupHtml = '<div class="map-popup-title">' + city.name + '</div>' +
                        '<div class="map-popup-chapter"><a href="' + chapterUrl + '">' + mapViewChapter + ' ' + city.chapter + '</a></div>';

        L.marker([city.lat, city.lng], { icon: markerIcon })
            .bindPopup(popupHtml)
            .addTo(map);
    });

    // Fit bounds to show all markers
    var group = L.featureGroup(cities.map(function (c) {
        return L.marker([c.lat, c.lng]);
    }));
    map.fitBounds(group.getBounds().pad(0.1));
});
