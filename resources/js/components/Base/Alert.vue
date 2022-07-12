<template>
  <!--begin::Alert-->
  <div :class="'alert-'+color" class="alert d-flex align-items-center p-5">
    <!--begin::Icon-->
    <!-- <span :class="'svg-icon-'+color" class="svg-icon svg-icon-2hx me-3">
    </span>-->
    <span class="svg-icon svg-icon-2hx svg-icon-primary me-3">
      <!--begin::Svg Icon | path: /var/www/preview.keenthemes.com/kt-products/metronic/releases/2022-07-05-142712/core/html/src/media/icons/duotune/general/gen044.svg-->
        <svg
          width="24"
          height="24"
          viewBox="0 0 24 24"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
          <rect
            x="11"
            y="14"
            width="7"
            height="2"
            rx="1"
            transform="rotate(-90 11 14)"
            fill="currentColor"
          />
          <rect
            x="11"
            y="17"
            width="2"
            height="2"
            rx="1"
            transform="rotate(-90 11 17)"
            fill="currentColor"
          />
        </svg>
      <!--end::Svg Icon-->
    </span>
    <!--end::Icon-->

    <!--begin::Wrapper-->
    <div class="d-flex flex-column">
      <!--begin::Title-->
      <h4 class="mb-1 text-dark">{{ title }}</h4>
      <!--end::Title-->
      <!--begin::Content-->
      <span>{{ message }}</span>
      <!--end::Content-->
    </div>
    <!--end::Wrapper-->
  </div>
  <!--end::Alert-->
</template>

<script>
export default {
  name: "Alert",
  props: ["color", "title", "message"],
};
</script>

<style>
</style>