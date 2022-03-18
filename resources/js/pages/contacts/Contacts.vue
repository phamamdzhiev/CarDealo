<template>
    <div class="custom-container-sm">
        <page-heading heading="Контакти"></page-heading>
        <base-card>
            <div class="row">
                <div class="col-xs-12 mb-3">
                    <div>
                        <p class="fw-bold mb-0">
                            <i class="fa-solid fa-envelope"></i>
                            Email
                        </p>
                    </div>
                    <div class="fs-5">
                        <a href="mailto:office@site.com" class="fw-light" target="_blank">office@site.com</a>
                    </div>
                </div>
                <hr/>
                <div class="col-xs-12">
                    <contact-form/>
                </div>
            </div>
        </base-card>
    </div>
</template>

<script>
import BaseCard from "../../components/ui/base/BaseCard";
import ContactForm from "./partials/ContactForm";
import PageHeading from "../../components/layout/PageHeading";

export default {
    name: "Contacts",
    components: {
        BaseCard,
        ContactForm,
        PageHeading
    }
}
</script>
