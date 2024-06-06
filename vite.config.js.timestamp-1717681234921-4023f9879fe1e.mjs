// vite.config.js
import { defineConfig } from "file:///C:/laragon/www/RWify/node_modules/vite/dist/node/index.js";
import laravel from "file:///C:/laragon/www/RWify/node_modules/laravel-vite-plugin/dist/index.js";
import { viteStaticCopy } from "file:///C:/laragon/www/RWify/node_modules/vite-plugin-static-copy/dist/index.js";
var vite_config_default = defineConfig({
  plugins: [
    laravel({
      input: [
        "resources/css/app.css",
        "resources/css/fonts.css",
        "resources/css/image-zoom.css",
        "resources/js/app.js",
        "resources/js/image-zoom.js",
        "resources/js/loading.js",
        "resources/js/utils/request.js",
        "resources/js/statisticChart.js",
        "resources/js/monthlyIuranCountChart.js"
      ],
      refresh: true
    })
  ],
  resolve: {
    alias: {
      "$": "jQuery"
    }
  }
});
export {
  vite_config_default as default
};
//# sourceMappingURL=data:application/json;base64,ewogICJ2ZXJzaW9uIjogMywKICAic291cmNlcyI6IFsidml0ZS5jb25maWcuanMiXSwKICAic291cmNlc0NvbnRlbnQiOiBbImNvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9kaXJuYW1lID0gXCJDOlxcXFxsYXJhZ29uXFxcXHd3d1xcXFxSV2lmeVwiO2NvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9maWxlbmFtZSA9IFwiQzpcXFxcbGFyYWdvblxcXFx3d3dcXFxcUldpZnlcXFxcdml0ZS5jb25maWcuanNcIjtjb25zdCBfX3ZpdGVfaW5qZWN0ZWRfb3JpZ2luYWxfaW1wb3J0X21ldGFfdXJsID0gXCJmaWxlOi8vL0M6L2xhcmFnb24vd3d3L1JXaWZ5L3ZpdGUuY29uZmlnLmpzXCI7aW1wb3J0IHsgZGVmaW5lQ29uZmlnIH0gZnJvbSBcInZpdGVcIjtcbmltcG9ydCBsYXJhdmVsIGZyb20gXCJsYXJhdmVsLXZpdGUtcGx1Z2luXCI7XG5pbXBvcnQgeyB2aXRlU3RhdGljQ29weSB9IGZyb20gXCJ2aXRlLXBsdWdpbi1zdGF0aWMtY29weVwiO1xuXG5leHBvcnQgZGVmYXVsdCBkZWZpbmVDb25maWcoe1xuICAgIHBsdWdpbnM6IFtcbiAgICAgICAgbGFyYXZlbCh7XG4gICAgICAgICAgICBpbnB1dDogW1xuICAgICAgICAgICAgICAgIFwicmVzb3VyY2VzL2Nzcy9hcHAuY3NzXCIsXG4gICAgICAgICAgICAgICAgXCJyZXNvdXJjZXMvY3NzL2ZvbnRzLmNzc1wiLFxuICAgICAgICAgICAgICAgIFwicmVzb3VyY2VzL2Nzcy9pbWFnZS16b29tLmNzc1wiLFxuICAgICAgICAgICAgICAgIFwicmVzb3VyY2VzL2pzL2FwcC5qc1wiLFxuICAgICAgICAgICAgICAgIFwicmVzb3VyY2VzL2pzL2ltYWdlLXpvb20uanNcIixcbiAgICAgICAgICAgICAgICBcInJlc291cmNlcy9qcy9sb2FkaW5nLmpzXCIsXG4gICAgICAgICAgICAgICAgXCJyZXNvdXJjZXMvanMvdXRpbHMvcmVxdWVzdC5qc1wiLFxuICAgICAgICAgICAgICAgIFwicmVzb3VyY2VzL2pzL3N0YXRpc3RpY0NoYXJ0LmpzXCIsXG4gICAgICAgICAgICAgICAgXCJyZXNvdXJjZXMvanMvbW9udGhseUl1cmFuQ291bnRDaGFydC5qc1wiLFxuICAgICAgICAgICAgXSxcbiAgICAgICAgICAgIHJlZnJlc2g6IHRydWUsXG4gICAgICAgIH0pLFxuICAgIF0sXG4gICAgcmVzb2x2ZToge1xuICAgICAgICBhbGlhczoge1xuICAgICAgICAgICAgJyQnOiAnalF1ZXJ5J1xuICAgICAgICB9LFxuICAgIH0sXG59KTtcbiJdLAogICJtYXBwaW5ncyI6ICI7QUFBc1AsU0FBUyxvQkFBb0I7QUFDblIsT0FBTyxhQUFhO0FBQ3BCLFNBQVMsc0JBQXNCO0FBRS9CLElBQU8sc0JBQVEsYUFBYTtBQUFBLEVBQ3hCLFNBQVM7QUFBQSxJQUNMLFFBQVE7QUFBQSxNQUNKLE9BQU87QUFBQSxRQUNIO0FBQUEsUUFDQTtBQUFBLFFBQ0E7QUFBQSxRQUNBO0FBQUEsUUFDQTtBQUFBLFFBQ0E7QUFBQSxRQUNBO0FBQUEsUUFDQTtBQUFBLFFBQ0E7QUFBQSxNQUNKO0FBQUEsTUFDQSxTQUFTO0FBQUEsSUFDYixDQUFDO0FBQUEsRUFDTDtBQUFBLEVBQ0EsU0FBUztBQUFBLElBQ0wsT0FBTztBQUFBLE1BQ0gsS0FBSztBQUFBLElBQ1Q7QUFBQSxFQUNKO0FBQ0osQ0FBQzsiLAogICJuYW1lcyI6IFtdCn0K
