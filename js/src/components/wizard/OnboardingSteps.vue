<template>
  <div class="root">
      <div class="w-full">
          <ul class="progressbar">
            <li v-for="i in numStep" :key="i" :class="isActive(i)"> </li>
         </ul>
      </div>
  </div>
</template>

<script>
export default {
  props: {
    'numStep': Number,
    'actStep': Number,
    },
  methods: {
    isActive: function(i) {
      if (i<=this.actStep)
        return 'active';
      else
        return '';
    }
  },
  data () {
    return {
    }
  }
}
</script>

<style scoped>

.progressbar{
  counter-reset: step;
  list-style-type: none;
}
.progressbar li{
  float: left;
  width: 33%;
  position: relative;
  text-align: center;
}
.progressbar li:before{
  content:counter(step);
  counter-increment: step;
  width: 50px;
  height: 30px;
  border: 2px solid #bebebe;
  display: block;
  margin: 0 auto 10px auto;
  border-radius: 10%;
  line-height: 27px;
  background: white;
  color: #bebebe;
  text-align: center;
  font-weight: bold;
}
.progressbar li:after{
  content: '';
  position: absolute;
  width:100%;
  height: 3px;
  background: #979797;
  top: 15px;
  left: -50%;
  z-index: -1;
}
.progressbar li.active:before{
 border-color: #3aac5d;
 background: #3aac5d;
 color: white
}
.progressbar li.active:after{
 background: #3aac5d;
}
.progressbar li:first-child:after{
 content: none;
}

</style>