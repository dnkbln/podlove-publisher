<template>
  <div class="flex flex-col min-h-screen">
    <div class="item">
      <onboarding-steps v-bind:numStep="numStep" v-bind:actStep="actStep"></onboarding-steps>
    </div>
    <div class="item flex-grow justify-center" v-if="actStep===1">
      <p> Welcome to the Podlove Publisher Onboarding </p>
    </div>
    <div class="item flex-grow" v-if="actStep===2">
      <onboarding-basic/>
    </div>
    <div class="item flex-grow" v-if="actStep===3">
      <onboarding-finish/>
    </div>
    <div class="grid grid-columns-12">
      <div class="item col-start-1">
        <button v-if="actStep > 1" v-on:click="prevStep" class="col-start-6 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-1 px-1 rounded inline-flex items-center">
          <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
          </svg>
        </button>
      </div>
      <div class="item col-start-2 col-span-10"> </div>
      <div class="item flex justify-end col-start-12">
        <div v-if="finish == 0">
        <button v-if="actStep < numStep" v-on:click="nextStep" class="col-start-6 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-1 px-1 rounded inline-flex items-center">
          <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
          </svg>
        </button>
        <button v-if="actStep == numStep" v-on:click="sendDataToPodlove" class="col-start-6 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-1 px-1 rounded inline-flex items-center">
          <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
            <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
          </svg>
        </button>
        </div>
        <a v-if="finish == 1" href="http://localhost:10003/wp-admin/admin.php?page=podlove_settings_handle">Finish</a> 
      </div>
    </div>
  </div>
</template>

<script>
import OnboardingBasic from './wizard/OnboardingBasic.vue';
import OnboardingFinish from './wizard/OnboardingFinish.vue';
import OnboardingSteps from './wizard/OnboardingSteps.vue'
export default {
  components:{
    OnboardingSteps,
    OnboardingBasic,
    OnboardingFinish
  },
  methods: {
    prevStep: function() {
      this.actStep = this.actStep - 1;
      if (this.actStep < 1)
        this.actStep = 1
    },
    nextStep: function() {
      this.actStep = this.actStep + 1;
      if (this.actStep > this.numStep)
        this.actStep = this.numStep;
    },
    sendDataToPodlove: function() {
      console.log('call axios');
      this.axios
        .patch('http://localhost:10003/wp-json/podlove/v1/podlove',
        {
          title: this.$store.getters.title,
          subtitle: this.$store.getters.subtitle,
          wizard: 1
        },
        {

        });
      this.finish = 1;
    }
  },
  data () {
    return {
      actStep: 1,
      numStep: 3,
      finish: 0
    }
  }
}
</script>

<style scoped>

.item {
    padding: 8px;
    border: 1px solid tomato;
    border-radius: 6px;
}
</style>

