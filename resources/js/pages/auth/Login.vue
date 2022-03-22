<template>
    <div class="custom-container-sm">
        <Tabs>
            <Tab name="Вход">
                <LoginForm/>
            </Tab>
            <Tab name="Регистрация">
                <RegisterForm/>
            </Tab>
        </Tabs>
    </div>
</template>

<script>
import {Tab, Tabs} from "vue3-tabs-component";
import LoginForm from "./LoginForm";
import RegisterForm from "./RegisterForm";

export default {
    name: "Login",
    components: {
        Tab,
        Tabs,
        LoginForm,
        RegisterForm
    },
}
</script>
