<template>
  <div class="space-x-2">
    <form v-on:submit.prevent="onSubmit">
    <fieldset class="item flex flex-col w-5/12 space-4 items-stretch border-4 border-grey-600 float-left grid-cols-3">
    <div class="s-2">
      <legend>Podcast Informationen</legend>
      <div class="flex items-center p-4">
        <label class="w-1/3 pr-2 ">Titel: Wie heißt Dein Podcast </label>
        <input class="form-input w-2/3 border-b-2 border-gray-400 col-start-3 col-span-3" @input="changedTitel" type="text" placeholder="Titel"/>
        <button class=" bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-1 px-1 rounded inline-flex items-center">
          <svg class="w-4 h-4 "xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
         </svg>
        </button>
      </div>
      <div class="flex items-center p-4">
        <label class="w-1/3 pr-2" >Untertitel: Um was geht es (kurz) </label>
        <input class="form-input w-2/3 border-b-2 border-gray-400" @input="changedSubtitel" type="text"  placeholder="Untertitel"/>
        <button class=" bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-1 px-1 rounded inline-flex items-center">
          <svg class="w-4 h-4 "xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
         </svg>
        </button>
      </div>
      <div class="flex items-center p-4">
        <label class="w-1/3 pr-2" >Zusammenfassung: Hier kannst Du ausführlich beschreiben um was es geht. </label>
        <textarea class="w-2/3 form-textarea border-2 border-gray-400" @input="changedSummary" type="text" placeholder="Zusammenfassung"/>
        <button class=" bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-1 px-1 rounded inline-flex items-center">
          <svg class="w-4 h-4"xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
       </button>
      </div>
    </div>
    </fieldset>
    <fieldset class="item flex flex-col w-5/12 items-stretch border-4 border-grey-600 float-right grid-cols-3">
    <div class="p-2">
      <legend>Podcast Betreiber Informationen</legend>
      <div class="flex items-center p-4">
        <label class="w-1/3 pr-2 ">Name des Authors</label>
        <input class="form-input w-2/3 border-b-2 border-gray-400 col-start-3 col-span-3" @input="changedTitel" type="text" placeholder="Author"/>
        <button class=" bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-1 px-1 rounded inline-flex items-center">
          <svg class="w-4 h-4 "xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
         </svg>
        </button>
      </div>
      <div class="flex items-center p-4">
        <label class="w-1/3 pr-2 ">Name des Besitzers</label>
        <input class="form-input w-2/3 border-b-2 border-gray-400 col-start-3 col-span-3" @input="changedTitel" type="text" placeholder="Besitzer"/>
        <button class=" bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-1 px-1 rounded inline-flex items-center">
          <svg class="w-4 h-4 "xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
         </svg>
        </button>
      </div>
      <div class="flex items-center p-4">
        <label class="w-1/3 pr-2 ">E-Mail des Besitzers</label>
        <input class="form-input w-2/3 border-b-2 border-gray-400 col-start-3 col-span-3" @input="changedTitel" type="text" placeholder="E-Mail"/>
        <button class=" bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-1 px-1 rounded inline-flex items-center">
          <svg class="w-4 h-4 "xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
         </svg>
        </button>
      </div>
    </div>
    </fieldset>
    </form>
  </div>
</template>

<script>
export default {
    components: {
    },
    methods: {
      changedTitel: function(event) {
        this.$store.commit("changeTitle", event.target.value)
      },
      changedSubtitel: function(event) {
        this.$store.commit("changeSubtitle", event.target.value)
      },
      changedSummary: function(event) {
        this.$store.commit("changeSummary", event.target.value)
      }
    },
    data () {
      return {
      }
    }
}
</script>
