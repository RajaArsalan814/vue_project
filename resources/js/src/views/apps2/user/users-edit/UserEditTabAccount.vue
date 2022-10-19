<template>
  <div>
    <!-- Media -->
    <b-media class="mb-2">
      <template #aside>
        <b-avatar ref="previewEl" :src="userData.avatar" :text="avatarText(userData.first_name)"
          :variant="`light-success}`" size="90px" rounded />
      </template>
      <h4 class="mb-1">
        {{ userData.first_name }} {{ userData.last_name }}
      </h4>
      <div class="d-flex flex-wrap">
        <b-button variant="primary" @click="$refs.refInputEl.click()">
          <input ref="refInputEl" type="file" class="d-none" @input="inputImageRenderer">
          <span class="d-none d-sm-inline">Update</span>
          <feather-icon icon="EditIcon" class="d-inline d-sm-none" />
        </b-button>
        <b-button variant="outline-secondary" class="ml-1">
          <span class="d-none d-sm-inline">Remove</span>
          <feather-icon icon="TrashIcon" class="d-inline d-sm-none" />
        </b-button>
      </div>
    </b-media>

    <!-- User Info: Input Fields -->
    <b-form @submit.prevent="onSubmit">
      <b-row>

        <!-- Field: Username -->
        <b-col cols="12" md="4">
          <b-form-group label="Teacher Nickname" label-for="username">
            <b-form-input id="username" v-model="userData.username" />
          </b-form-group>
        </b-col>

        <!-- Field: Full Name -->
        <b-col cols="12" md="4">
          <b-form-group label="First Name" label-for="full-name">
            <b-form-input id="full-name" v-model="userData.first_name" />
          </b-form-group>
        </b-col>
        <!-- Field: Full Name -->
        <b-col cols="12" md="4">
          <b-form-group label="Last Name" label-for="last-name">
            <b-form-input id="last-name" v-model="userData.last_name" />
          </b-form-group>
        </b-col>
        <!-- Field: Registration Date -->
        <b-col cols="12" md="4">
          <b-form-group label="Registration Date" label-for="registration-date">
            <b-form-input id="full-registration-date" v-model="userData.created_at" />
          </b-form-group>
        </b-col>
        <!-- Field: Mobile -->
        <b-col cols="12" md="4">
          <b-form-group label="Phone No" label-for="phone_number">
            <b-form-input id="phone_number" v-model="userData.phone_number" />
          </b-form-group>
        </b-col>
        <!-- Field: Gender -->
        <b-col cols="12" md="4">
          <b-form-group label="Gender" label-for="gender" label-class="mb-1">
            <b-form-radio-group id="gender" v-model="userData.gender" :options="genderOptions" value="male" />
          </b-form-group>
        </b-col>

        <!-- Field: Mobile -->
        <b-col cols="12" md="4">
          <b-form-group label="IC No." label-for="ic_no">
            <b-form-input id="ic_no" v-model="userData.ic_no" />
          </b-form-group>
        </b-col>
        <!-- Field: Education level -->
        <b-col cols="12" md="4">
          <b-form-group label="Education level." label-for="education_level">
            <b-form-input id="education_level" placeholder="Eg: Bachelors in English"
              v-model="userData.education_level" />
          </b-form-group>
        </b-col>

        <!-- Field: Email -->
        <b-col cols="12" md="4">
          <b-form-group label="Email" label-for="email">
            <b-form-input id="email" v-model="userData.email" type="email" />
          </b-form-group>
        </b-col>
        <!-- Field: Teacher type -->
        <b-col cols="12" md="4">
          <b-form-group label="Teacher type" label-for="teacher_type">
            <v-select v-model="userData.teacher_type" :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
              :options="teacherTypeOptions" :reduce="val => val.value" :clearable="false" input-id="teacher_type" />
          </b-form-group>
        </b-col>
        <!-- Field: Status -->
        <b-col cols="12" md="4">
          <b-form-group label="Status" label-for="user-status">
            <v-select v-model="userData.status" :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
              :options="statusOptions" :reduce="val => val.value" :clearable="false" input-id="user-status" />
          </b-form-group>
        </b-col>


        <!-- Field: Status -->
        <b-col cols="12" md="4">
          <b-form-group label="Full Address" label-for="address">
            <b-form-textarea id="address" v-model="userData.address" rows="3" required />
          </b-form-group>
        </b-col>
        <b-col cols="12" md="4">
          <b-button variant="primary" class="mb-1 mb-sm-0 mr-0 mr-sm-1" type="submit">
            Save Changes
          </b-button>
        </b-col>

        <!-- Field: Email -->

      </b-row>
    </b-form>
    <b-form @submit.prevent="onSubmitPermission">
    <!-- PERMISSION TABLE -->
    <b-card no-body class="border mt-1">
      <b-card-header class="p-1">
        <b-card-title class="font-medium-2">
          <feather-icon icon="LockIcon" size="18" />
          <span class="align-middle ml-50">Module Access</span>
        </b-card-title>
      </b-card-header>
      <div v-for="(item) in getGlPermission" :key="item.value">
        <b-table striped responsive class="mb-0" :items="item">
          <template #cell(Global_Level)="data">
            <b-form-radio name="gls_data" :id="`g-l-${Math.floor(Math.random() * 1000)}`"  v-model="t_gls" :value=data.value.id :selected="data.value.active">{{ data.value.name }}</b-form-radio>
          </template>
          <template #cell()="data">
            <b-form-checkbox :value="`${data.value.id+'|'+data.value.gls_id}`" v-model="t_module"/>
          </template>
        </b-table>
      </div>
    <!--   <div>Selected: <strong>{{ t_gls }}</strong></div>
      <div>Selected: <strong>{{ t_module }}</strong></div> -->
    </b-card>

    <!-- Action Buttons -->
    <b-button variant="primary" class="mb-1 mb-sm-0 mr-0 mr-sm-1" type="submit">
      Save Changes
    </b-button>

  </b-form>
  </div>
</template>

<script>
import {
  BButton,
  BMedia,
  BAvatar,
  BRow,
  BFormRadioGroup,
  BFormRadio,
  BCol,
  BFormGroup,
  BFormInput,
  BForm,
  BTable,
  BFormTextarea,
  BCard,
  BCardHeader,
  BCardTitle,
  BFormCheckbox,
} from 'bootstrap-vue'
import { avatarText } from '@core/utils/filter'
import vSelect from 'vue-select'
import { useInputImageRenderer } from '@core/comp-functions/forms/form-utils'
import { ref } from '@vue/composition-api'
import useUsersList from '../users-list/useUsersList'
import { useToast } from 'vue-toastification/composition'
import Toast from "vue-toastification";
import ToastificationContent from '@core/components/toastification/ToastificationContent.vue'
import store from '@/store'
export default {
  components: {
    BButton,
    BMedia,
    BFormRadio,
    BFormRadioGroup,
    BAvatar,
    BFormTextarea,
    BRow,
    BCol,
    BFormGroup,
    BFormInput,
    BForm,
    BTable,
    BCard,
    BCardHeader,
    BCardTitle,
    BFormCheckbox,
    vSelect,
  },
  props: {
    userData: {
      type: Object,
      required: true,
    },
  },
  
  data() {
    return {
      getGlPermission:[],
      t_module:[],
      t_gls:'', 
    }
  },
  methods: {
    //getPremission() {
      getPremission: function () {	
      store
        .dispatch('app-user/fetchGls',this.userData.user_id)
        .then(response => {
          this.getGlPermission = response.data.data
          this.t_gls = response.data.active
          this.t_module = response.data.module_active
          console.log(this.t_module)
        })
    }, 
    onSubmitPermission() { 
      
      store.dispatch('app-user/updatePermissions', {'gls_id':this.t_gls,'modules':this.t_module,'id':this.userData.user_id}).then(() => {
        this.$toast({
          component: ToastificationContent,
          props: {
            title: "Teacher Module Access Updated",
            icon: "CheckCircleIcon",
            variant: "success",
          },
        });
      }).catch((error) => { 
        console.log(error) 
      });
    }, 
  },
  mounted() {
    this.getPremission(); 
  },
  setup(props) {
    const { resolveUserRoleVariant } = useUsersList()
    const toast = useToast()
    const roleOptions = [
      { label: 'Admin', value: 'admin' },
      { label: 'Author', value: 'author' },
      { label: 'Editor', value: 'editor' },
      { label: 'Maintainer', value: 'maintainer' },
      { label: 'Subscriber', value: 'subscriber' },
    ]

    const statusOptions = [
      { label: 'Pending', value: 'pending' },
      { label: 'Active', value: 'active' },
      { label: 'Inactive', value: 'inactive' },
      { label: 'Halted', value: 'alted' },
    ]

    const genderOptions = [
      { text: 'Male', value: 'Male' },
      { text: 'Female', value: 'Female' },
    ]

    const teacherTypeOptions = [
      { label: 'Group', value: 'group' },
      { label: 'Private', value: 'private' },
      { label: 'Both', value: 'both' },
    ]

    const permissionsData = {
      item: [
        {
          module: 'Globle Level 111',
          mod_7: true,
          mod_8: true,
          mod_9: true,
          mod_10: false,
        }
      ],
      item1: [
        {
          module: 'Globle Level 2',
          mod_11: true,
          mod_12: false,
          mod_13: true,
          mod_14: false,
        }
      ],
      item2: [
        {
          module: 'Globle Level 3',
          mod_15: true,
        }
      ],
    }

    // ? Demo Purpose => Update image on click of update
    const refInputEl = ref(null)
    const previewEl = ref(null)
    const blankUserData = {
      fullName: '',
      username: '',
      email: '',
      role: null,
      currentPlan: null,
      company: '',
      country: '',
      contact: '',
    }
    const pdata = {
      fullName: '',
      username: '',
      email: '',
      role: null,
      currentPlan: null,
      company: '',
      country: '',
      contact: '',
    }

    //    const userData = ref(JSON.parse(JSON.stringify(blankUserData)))

    const { inputImageRenderer } = useInputImageRenderer(refInputEl, base64 => {
      // eslint-disable-next-line no-param-reassign
      props.userData.avatar = base64
    })
    const onSubmit = () => {
      store.dispatch('app-user/updateUser', props.userData).then(() => {
        toast({
          component: ToastificationContent,
          props: {
            title: "Teacher Updated Successfully",
            icon: "CheckCircleIcon",
            variant: "success",
          },
        });
      }).catch((error) => { 
        console.log(error)
        var e = error.response.data.message;
        Object.keys(e).forEach((key) => {
          toast({
            component: ToastificationContent,
            props: {
              title: e[key][0],
              icon: "AlertTriangleIcon",
              variant: "danger",
            },
          });
        });
      });
    } 
    return { 
      avatarText,
      genderOptions,
      onSubmit,
      pdata, 
      roleOptions,
      teacherTypeOptions,
      statusOptions,
      permissionsData,

      //  ? Demo - Update Image on click of update button
      refInputEl,
      previewEl,
      inputImageRenderer,
    }
  },
}
</script>

<style lang="scss">
@import '~@resources/scss/vue/libs/vue-select.scss';
</style>
