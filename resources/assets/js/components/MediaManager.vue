<template>
  <div class="media-manager">
    <lyra-loader v-if="$root.loader === false && !disks && !folderTree" class="py-5"></lyra-loader>
    <template v-else>
      <div class="border-bottom justify-content-between m-0 py-2 row">
        <div class="col-12 col-sm-8 col-lg-10">
          <Breadcrumb :key="$route.fullPath" @change-path="changePathEvent"
                      @drop-element-move="moveDraggedElements"
                      @drop-element-copy="copyDraggedElements"></Breadcrumb>
        </div>
        <div class="col-12 col-sm-4 col-lg-2 align-self-center">
          <div class="form-group row m-0">
            <label for="selectDisk" class="col-4 col-md-5 text-right col-form-label">Disk:</label>
            <div class="col-8 col-md-7 px-0">
              <select class="form-control" v-model="selectedDisk" id="selectDisk">
                <option :value="disk" v-for="disk in disks">{{disk}}</option>
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="row m-0 media-viewer-container">
        <div class="col-12 media-viewer pl-3 px-0">
          <MediaViewer :key="$route.fullPath" :folder-tree="folderTree" ref="media_viewer"
                       @change-path="changePathEvent" @reload-manager="reloadManager"></MediaViewer>
        </div>
      </div>
    </template>
  </div>
</template>
<script>
  import Breadcrumb from './Media/Breadcrumb'
  import FolderTree from './Media/TreeFolder'
  import MediaViewer from './Media/MediaViewer'

  export default {
    components: {Breadcrumb, FolderTree, MediaViewer},
    data() {
      return {
        disks: null,
        selectedDisk: this.$route.query.disk,
        currentPath: this.$route.query.path ? this.$route.query.path : '/',
        folderTree: null
      }
    },
    methods: {
      getDisks: function () {
        const path = this.$route.fullPath.split('?')[0];
        const query = this.$route.fullPath.split('?')[1];
        this.$http.get(`${path}/disks?${query}`).then((response) => {
          this.disks = response.data.disks;
          this.selectedDisk = response.data.selected;
        });
      },
      changePathEvent: function (path) {
        this.$router.push({query: {...this.$route.query, path}});
      },
      getFolderTree: function () {
        const path = this.$route.fullPath.split('?')[0];
        const query = this.$route.fullPath.split('?')[1];
        this.$http.get(`${path}/tree?${query}`).then(response => this.folderTree = response.data);
      },
      reloadManager: function () {
        this.folderTree = null;
        this.getFolderTree();
      },
      moveDraggedElements: function (path) {
        this.$refs.media_viewer.moveDraggedElements(path);
      },
      copyDraggedElements: function (path) {
        this.$refs.media_viewer.copyDraggedElements(path);
      },
    },
    watch: {
      '$route': function (to, from) {
        this.currentPath = to.query.path ? to.query.path : '/';
      },
      selectedDisk: function (to, from) {
        this.$router.push({query: {...this.$route.query, disk: to, path: null}});
      }
    },
    beforeMount() {
      this.getFolderTree();
      this.getDisks();
    }
  }
</script>
<style scoped>

</style>
