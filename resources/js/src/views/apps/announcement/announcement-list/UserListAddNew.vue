<template>
  <b-sidebar id="add-new-user-sidebar" :visible="isAddNewUserSidebarActive" bg-variant="white"
    sidebar-class="sidebar-lg" shadow backdrop no-header right @hidden="resetForm"
    @change="(val) => $emit('update:is-add-new-user-sidebar-active', val)">
    <template #default="{ hide }">
      <!-- Header -->
      <div class="
          d-flex
          justify-content-between
          align-items-center
          content-sidebar-header
          px-2
          py-1
        ">
        <h5 class="mb-0">Add New User</h5>

        <feather-icon class="ml-1 cursor-pointer" icon="XIcon" size="16" @click="hide" />
      </div>

      <!-- BODY -->
      <validation-observer #default="{ handleSubmit }" ref="refFormObserver">
        <!-- Form -->
        <b-form class="p-2" @submit.prevent="handleSubmit(onSubmit)" @reset.prevent="resetForm">
          <!-- title -->
          <validation-provider #default="validationContext" name="title" rules="required">
            <b-form-group label="Title" label-for="title">
              <b-form-input id="title" v-model="userData.title" autofocus :state="getValidationState(validationContext)"
                trim placeholder="" />

              <b-form-invalid-feedback>
                {{ validationContext.errors[0] }}
              </b-form-invalid-feedback>
            </b-form-group>
          </validation-provider>

          <!-- Announcement Time -->
          <validation-provider #default="validationContext" name="Announcement Date" rules="required">
            <b-form-group label="Announcement Date" label-for="announcement_date">

              <b-form-datepicker id="example-datepicker" v-model="userData.announcement_date" class="mb-1" />

              <template #code>
                {{ codeBasic }}
              </template>
              <b-form-invalid-feedback>
                {{ validationContext.errors[0] }}
              </b-form-invalid-feedback>
            </b-form-group>
          </validation-provider>

          <!-- Announcement Time -->
          <validation-provider #default="validationContext" name="Announcement Time" rules="required">
            <b-form-group label="Announcement Time" label-for="announcement_time">
              <b-form-timepicker v-model="userData.announcement_time" locale="en" />
              <template #code>
                {{ codeBasic }}
              </template>
              <b-form-invalid-feedback>
                {{ validationContext.errors[0] }}
              </b-form-invalid-feedback>
            </b-form-group>
          </validation-provider>

          <!-- Announcement Time -->
          <validation-provider #default="validationContext" name="description" rules="required">
            <b-form-group label="Description" label-for="description">
              <b-form-textarea id="description" v-model="userData.description" rows="3" required />
              <template #code>
                {{ codeBasic }}
              </template>
              <b-form-invalid-feedback>
                {{ validationContext.errors[0] }}
              </b-form-invalid-feedback>
            </b-form-group>
          </validation-provider>

          <!-- Announcement Type -->
          <validation-provider #default="validationContext" name="Announcement Type" rules="required">
            <b-form-group label="Announcement Type" label-for="announcement_type"
              :state="getValidationState(validationContext)">
              <v-select v-model="userData.announcement_type" :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
                :options="roleOptions" :reduce="(val) => val.value" :clearable="false" input-id="announcement_type" />
              <b-form-invalid-feedback :state="getValidationState(validationContext)">
                {{ validationContext.errors[0] }}
              </b-form-invalid-feedback>
            </b-form-group>
          </validation-provider> 
          <b-form-group
            label="Announced Audience"
            label-for="announced_audience"
            label-class="mb-1"
          >
            <b-form-checkbox-group
              id="announced_audience"
              v-model="selected"
              :options="planOptions"
            />
          </b-form-group>
          <!-- Form Actions -->
          <div class="d-flex mt-2">
            <b-button v-ripple.400="'rgba(255, 255, 255, 0.15)'" variant="primary" class="mr-2" type="submit">
              Add
            </b-button>
            <b-button v-ripple.400="'rgba(186, 191, 199, 0.15)'" type="button" variant="outline-secondary"
              @click="hide">
              Cancel
            </b-button>
          </div>
        </b-form>
      </validation-observer>
    </template>
  </b-sidebar>
</template>

<script>
import {
  BSidebar,
  BForm,
  BFormGroup,
  BFormInput,
  BFormInvalidFeedback,
  BButton,
  BFormDatepicker,
  BFormTextarea,
    BFormCheckboxGroup,
  BFormTimepicker,BFormCheckbox,
} from "bootstrap-vue";
import { ValidationProvider, ValidationObserver } from "vee-validate";
import { ref, watch } from "@vue/composition-api";
import { required, alphaNum, email } from "@validations";
import formValidation from "@core/comp-functions/forms/form-validation";
import Ripple from "vue-ripple-directive";
import vSelect from "vue-select";
import countries from "@/@fake-db/data/other/countries";
import store from "@/store";
import { codeBasic } from "./code";
import { useToast } from 'vue-toastification/composition'
import ToastificationContent from '@core/components/toastification/ToastificationContent.vue'
export default {
  components: {
    BSidebar,
    BFormCheckbox,
    BFormDatepicker,
    BFormTimepicker,
    BForm,
    BFormCheckboxGroup,
    BFormGroup,
    BFormInput,
    BFormTextarea,
    BFormInvalidFeedback,
    BButton,
    vSelect,

    // Form Validation
    ValidationProvider,
    ValidationObserver,
  },
  directives: {
    Ripple,
  },
  model: {
    prop: "isAddNewUserSidebarActive",
    event: "update:is-add-new-user-sidebar-active",
  },
  props: {
    isAddNewUserSidebarActive: {
      type: Boolean,
      required: true,
    },
    roleOptions: {
      type: Array,
      required: true,
    },
    planOptions: {
      type: Array,
      required: true,
    },
  },
  
  data() {
    return {
      required,
      alphaNum,
      email,
      countries,
    };
  },
   
  setup(props, { emit }) {
    const toast = useToast()
    const blankUserData = {
      title: "",
      announcement_time: "",
      announcement_type: "",
      announcement_date: "",
      description: "",
      announced_audience:[]
    };

    const userData = ref(JSON.parse(JSON.stringify(blankUserData)));
    const resetuserData = () => {
      userData.value = JSON.parse(JSON.stringify(blankUserData));
    };
    const selected = [];
    const onSubmit = () => {
      userData.value.announced_audience = selected;
      store
        .dispatch("app-user/addUser", userData.value)
        .then(() => {
          emit("refetch-data");
          emit("update:is-add-new-user-sidebar-active", false);
          toast({
            component: ToastificationContent,
            props: {
              title: "Announcement Created Successfully",
              icon: "CheckCircleIcon",
              variant: "success",
            },
          });
          refetchData();
        })
        .catch((error) => {
          console.log(error.response)
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
    };

    const { refFormObserver, getValidationState, resetForm } =
      formValidation(resetuserData);

    return {
      userData,
      onSubmit,
      selected: [],
      codeBasic,
      refFormObserver,
      getValidationState,
      resetForm,
    };
  },
};
</script>

<style lang="scss">
@import "~@resources/scss/vue/libs/vue-select.scss";

#add-new-user-sidebar {
  .vs__dropdown-menu {
    max-height: 200px !important;
  }
}
</style>
