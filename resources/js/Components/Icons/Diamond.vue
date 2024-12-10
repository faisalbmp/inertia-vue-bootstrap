<template>
  <svg xmlns="http://www.w3.org/2000/svg" :width="size" :height="size" viewBox="0 0 17.948 13.448">
      <g>
          <path fill="#e53b25" d="M6.8 11.292l2.7 6.75-6.711-7.2zm7.989-1.278L13.165 5.9H9.836l-1.6 4.134zm-6.5 1.331l3.215 8 3.242-7.989zM13.5 18l6.711-7.157-3.994.466zm6.99-8.568l-3.55-3.346a.666.666 0 0 0-.466-.186H14.6l1.564 4.061zM8.405 5.9H6.528a.666.666 0 0 0-.466.186L2.54 9.475l4.3.486z" transform="translate(-2.54 -5.9)"/>
      </g>
  </svg>
</template>

<script>
export default {
  name: 'Diamond',
  props: {
    size: {
      type: String,
      default: '17'
    }
  }
}
</script>