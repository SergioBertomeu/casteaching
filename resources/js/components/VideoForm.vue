<template>
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 mb-1 md:mb-2 lg:mb-4">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="md:grid md:grid-cols-3 md:gap-6 bg-white md:bg-transparent">
                <div class="md:col-span-1">
                    <div class="px-4 py-4 sm:px-6 md:px-4">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Vídeos</h3>
                        <p class="mt-1 text-sm text-gray-600">
                            Informació bàsica del vídeo
                        </p>
                    </div>
                </div>
                <div class="md:mt-0 md:col-span-2">
                    <form data-qa="form_video_create" @submit.prevent="save" method="POST" >
                        <div class="shadow sm:rounded-md sm:overflow-hidden md:bg-white">
                            <div class="px-4 py-5 space-y-6 sm:p-6">

                                <div>
                                    <label for="title" class="block text-sm font-medium text-gray-700">
                                        Title
                                    </label>
                                    <div class="mt-1">
                                        <input required type="text" id="title" v-model="video.title" name="title" rows="3" class="shadow-sm mt-1 block w-full sm:text-sm border border-gray-300 rounded-md p-2" placeholder="Titol del vídeo"></input>
                                    </div>
                                    <p class="mt-2 text-sm text-gray-500">
                                        Titol curt del vídeo
                                    </p>
                                </div>

                                <div>
                                    <label for="description" class="block text-sm font-medium text-gray-700">
                                        Description
                                    </label>
                                    <div class="mt-1">
                                        <textarea required v-model="video.description" id="description" name="description" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md" placeholder="Description"></textarea>
                                    </div>
                                    <p class="mt-2 text-sm text-gray-500">
                                        Breu descripció del vídeo
                                    </p>
                                </div>

                                <div class="grid grid-cols-3 gap-6">
                                    <div class="col-span-3">
                                        <label for="url" class="block text-sm font-medium text-gray-700">
                                            URL
                                        </label>
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                                          <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                                            http://
                                                          </span>
                                            <input v-model="video.url" required type="url" name="url" id="url" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block  rounded-none rounded-r-md sm:text-sm border-gray-300" placeholder="youtube.com/">
                                        </div>
                                    </div>
                                </div>



                            </div>
                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <span v-if="status==='creating'">Crear</span>
                                    <span v-if="status==='editing'">Editar</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import bus from '../bus.js'
export default {
    name: "VideoForm",
    data() {
      return {
          video: {},
          status: 'creating'
      }
    },
    methods: {
        save() {
            if (this.status ==='creating') {
                this.store()
            }
            if (this.status ==='editing') {
                this.update()
            }

        },
        store() {
            try {
                window.casteaching.video.create({
                    title: this.video.title,
                    description: this.video.description,
                    url: this.video.url
                })
                bus.$emit('created')
                bus.$emit('status','Video created successfully')
            } catch (error) {
                console.log(error);
            }
        },
        update() {
            try {
                window.casteaching.video.update(this.video.id , {
                    title: this.video.title,
                    description: this.video.description,
                    url: this.video.url
                })
                bus.$emit('created')
                bus.$emit('status','Video updated successfully')
            } catch (error) {
                console.log(error);
            }
        }
    },
    created () {
        bus.$on('edit',(video) => {
            this.video = video
            this.status = 'editing'
        })
    }
}
</script>

<style scoped>

</style>
