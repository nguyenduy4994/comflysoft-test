import 'ol/ol.css';
import { Circle, Fill, Style } from 'ol/style';
import { Feature, Map, Overlay, View } from 'ol/index';
import { OSM, Vector as VectorSource } from 'ol/source';
import { Point } from 'ol/geom';
import { Tile as TileLayer, Vector as VectorLayer } from 'ol/layer';
import { useGeographic } from 'ol/proj';
import { Circle as GeomCircle } from 'ol/geom';

useGeographic();

var currentPoint = new Point(currentPointPosition);

var exposedPointFeatures = exposedPointPositions.map((item) => {
    return new Feature(new Point(item));
});

var circleFeature = new Feature({
    geometry: new GeomCircle(currentPointPosition, RADIUS / 100000),
});
circleFeature.setStyle(
    new Style({
        renderer: function renderer(coordinates, state) {
            var coordinates_0 = coordinates[0];
            var x = coordinates_0[0];
            var y = coordinates_0[1];
            var coordinates_1 = coordinates[1];
            var x1 = coordinates_1[0];
            var y1 = coordinates_1[1];
            var ctx = state.context;
            var dx = x1 - x;
            var dy = y1 - y;
            var radius = Math.sqrt(dx * dx + dy * dy);

            var innerRadius = 0;
            var outerRadius = radius * 1.4;

            var gradient = ctx.createRadialGradient(
                x,
                y,
                innerRadius,
                x,
                y,
                outerRadius
            );
            gradient.addColorStop(0, 'rgba(255,0,0,0)');
            gradient.addColorStop(0.6, 'rgba(255,0,0,0.2)');
            gradient.addColorStop(1, 'rgba(255,0,0,0.8)');
            ctx.beginPath();
            ctx.arc(x, y, radius, 0, 2 * Math.PI, true);
            ctx.fillStyle = gradient;
            ctx.fill();

            ctx.arc(x, y, radius, 0, 2 * Math.PI, true);
            ctx.strokeStyle = 'rgba(255,0,0,1)';
            ctx.stroke();
        },
    })
);

var map = new Map({
    target: 'map',
    view: new View({
        center: currentPointPosition,
        zoom: 18,
    }),
    layers: [
        new TileLayer({
            source: new OSM(),
        }),

        new VectorLayer({
            source: new VectorSource({
                features: [circleFeature],
            }),
        }),

        new VectorLayer({
            source: new VectorSource({
                features: [new Feature(currentPoint)],
            }),
            style: new Style({
                image: new Circle({
                    radius: 9,
                    fill: new Fill({ color: 'red' }),
                }),
            }),
        }),

        new VectorLayer({
            source: new VectorSource({
                features: exposedPointFeatures,
            }),
            style: new Style({
                image: new Circle({
                    radius: 9,
                    fill: new Fill({ color: 'blue' }),
                }),
            }),
        }),
    ],
});
