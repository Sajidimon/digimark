<template>
    <Layout>
        <div>
            <Head title="Dashboard Setting" />
        </div>

        <div class="mx-4 max-w-screen-xl sm:mx-8 xl:mx-auto">
            <form @submit.prevent="submit">
                <h1 class="border-b py-6 text-4xl font-semibold">Settings</h1>
                <div
                    class="grid grid-cols-8 pt-3 pb-10 sm:grid-cols-10 sm:bg-gray-50"
                >
                    <div class="col-span-8 overflow-hidden rounded-xl sm:px-8">
                        <div class="space-y-1">
                            <div class="rounded-md bg-white">
                                <div
                                    class="flex flex-col space-y-3 px-4 py-6 sm:px-10"
                                >
                                    <label class="block" for="name">
                                        <p>Header Logo</p>
                                        <img
                                            class="w-32 h-24 rounded my-5"
                                            id="HeaderLogo"
                                            v-if="
                                                HeaderlogoPreview ||
                                                props.settingsData[0]
                                                    ?.HeaderLogo
                                            "
                                            :src="
                                                HeaderlogoPreview ||
                                                `/storage/${props.settingsData[0]?.HeaderLogo}`
                                            "
                                            alt=""
                                        />
                                        <InputText
                                            @change="HandleHeaderLogo"
                                            type="file"
                                        />
                                        <p class="mt-2 text-sm">
                                            Upload logo: 192px width x 85px
                                            height
                                        </p>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="col-span-8 my-5 overflow-hidden rounded-xl sm:px-8"
                    >
                        <div class="space-y-1">
                            <div class="rounded-md bg-white">
                                <div
                                    class="flex flex-col space-y-3 px-4 py-6 sm:px-10"
                                >
                                    <label class="block" for="name">
                                        <p>Hero Image</p>
                                        <img
                                            class="w-32 h-24 rounded my-5"
                                            id="herobgimage"
                                            v-if="
                                                herobgimagePreview ||
                                                props.settingsData[0]
                                                    ?.herobgimage
                                            "
                                            :src="
                                                herobgimagePreview ||
                                                `/storage/${props.settingsData[0]?.herobgimage}`
                                            "
                                            alt=""
                                        />
                                        <InputText
                                            @change="Handleherobgimage"
                                            type="file"
                                        />
                                        <p class="mt-2 text-sm">
                                            Upload logo: 192px width x 85px
                                            height
                                        </p>
                                    </label>
                                    <label class="block" for="name">
                                        <p>Heading</p>

                                        <InputText
                                            type="text"
                                            v-model="form.heading"
                                            placeholder="Enter Heading"
                                        />
                                    </label>
                                    <label class="block">
                                        <p>Sub Heading</p>

                                        <InputText
                                            type="text"
                                            v-model="form.SubHeading"
                                            placeholder="Enter Subheading"
                                        />
                                    </label>
                                    <label class="block">
                                        <p>Shop Link</p>

                                        <InputText
                                            type="url"
                                            v-model="form.ButtonLink"
                                            placeholder="Enter shop URL"
                                        />
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-8 overflow-hidden rounded-xl sm:px-8">
                        <div class="space-y-1">
                            <div class="rounded-md bg-white">
                                <div
                                    class="flex flex-col space-y-3 px-4 pb-6 sm:px-10"
                                >
                                    <label class="block" for="name">
                                        <p>Footer Logo</p>
                                        <img
                                            class="w-32 h-24 rounded my-5"
                                            id="HeaderLogo"
                                            v-if="
                                                FooterlogoPreview ||
                                                props.settingsData[0]
                                                    ?.FooterLogo
                                            "
                                            :src="
                                                FooterlogoPreview ||
                                                `/storage/${props.settingsData[0]?.FooterLogo}`
                                            "
                                            alt=""
                                        />
                                        <InputText
                                            @change="HandleFooterLogo"
                                            type="file"
                                        />
                                        <p class="mt-2 text-sm">
                                            Upload logo: 290px width x 85px
                                            height
                                        </p>
                                    </label>
                                    <label class="block" for="description">
                                        <p class="mb-4">Footer Description</p>
                                        <textarea
                                            id="description"
                                            cols="30"
                                            v-model="form.FooterDescription"
                                            rows="10"
                                            class="w-full rounded-md border p-4 bg-gray-50 outline-none ring-blue-600"
                                        >
                                        </textarea>
                                    </label>
                                    <label class="block" for="name">
                                        <p>Footer Social profile</p>

                                        <InputText
                                            type="url"
                                            v-model="form.Footerfb"
                                            placeholder="Enter Facebook URL"
                                        />
                                        <InputText
                                            type="url"
                                            v-model="form.Footeryt"
                                            placeholder="Enter Youtube URL"
                                        />
                                        <InputText
                                            type="url"
                                            v-model="form.Footerinsta"
                                            placeholder="Enter Instagram URL"
                                        />
                                    </label>

                                    <label class="block" for="name">
                                        <p>Copyright Text</p>

                                        <InputText
                                            type="text"
                                            v-model="form.copyright"
                                            placeholder="Enter Copyright text"
                                        />
                                    </label>
                                    <button
                                        class="mt-4 ml-auto rounded-lg bg-blue-600 px-10 py-2 text-white"
                                    >
                                        Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </Layout>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import Layout from "../../Layouts/Layout.vue";
import InputText from "../../Components/InputText.vue";
import { ref } from "vue";
import { toast } from "vue3-toastify";

const props = defineProps({
    settingsData: Array,
});

const HeaderlogoPreview = ref(null);
const FooterlogoPreview = ref(null);
const herobgimagePreview = ref(null);

const form = useForm({
    HeaderLogo: "",
    herobgimage: "",
    heading: props.settingsData[0]?.heading || "",
    SubHeading: props.settingsData[0]?.SubHeading || "",
    ButtonLink: props.settingsData[0]?.ButtonLink || "",
    FooterLogo: "",
    FooterDescription: props.settingsData[0]?.FooterDescription || "",
    Footerfb: props.settingsData[0]?.Footerfb || "",
    Footeryt: props.settingsData[0]?.Footeryt || "",
    Footerinsta: props.settingsData[0]?.Footerinsta || "",
    copyright: props.settingsData[0]?.copyright || "",
    _method: "patch",
});

function HandleHeaderLogo(event) {
    const file = event.target.files[0];
    if (file) {
        form.HeaderLogo = event.target.files[0];
        HeaderlogoPreview.value = URL.createObjectURL(file);
    }
}
function Handleherobgimage(event) {
    const file = event.target.files[0];
    if (file) {
        form.herobgimage = event.target.files[0];
        herobgimagePreview.value = URL.createObjectURL(file);
    }
}

function HandleFooterLogo(event) {
    const file = event.target.files[0];
    if (file) {
        form.FooterLogo = event.target.files[0];
        FooterlogoPreview.value = URL.createObjectURL(file);
    }
}

function submit() {
    form.post("/settings", {
        preserveScroll: true,
        onSuccess: () => {
            toast("sattings saved", { type: "success" });
        },
    });
}
</script>
