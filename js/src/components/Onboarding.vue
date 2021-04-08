<template>
  <div class="app">
    <div class="grid">
      <div class="item">
        <onboarding-steps v-bind:numStep="numStep" v-bind:actStep="actStep"></onboarding-steps>
      </div>
      <div class="item bg-blue-300 flex justify-center" v-if="actStep===1">
        <p> Welcome to the Podlove Publisher Onboarding </p>
      </div>
      <div class="item " v-if="actStep===2">
        <onboarding-basic v-bind:title="title" v-bind:subtitle="subtitle"/>
      </div>
      <div class="item" v-if="actStep===3">
        <p> Daten fuer den Publisher: </p>
        <p> title {{$store.getters.title}} </p>
        <p> subtitle {{$store.getters.subtitle}} </p>
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
          <button v-if="actStep < numStep" v-on:click="nextStep" class="col-start-6 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-1 px-1 rounded inline-flex items-center">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
            </svg>
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import OnboardingBasic from './wizard/OnboardingBasic.vue';
import OnboardingSteps from './wizard/OnboardingSteps.vue'
export default {
  components:{
    OnboardingSteps,
    OnboardingBasic
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
    }
  },
  data () {
    return {
      actStep: 1,
      numStep: 3,
      title: 'text',
      subtitle: '',
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

