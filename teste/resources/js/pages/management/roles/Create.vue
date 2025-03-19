<script setup>
import { Head, useForm } from '@inertiajs/vue3'
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import AppLayout from "@/layouts/AppLayout.vue";

const form = useForm({
    name: ''
})

const submit = () => {
    form.post(route('roles.store'), {
        onSuccess: () => form.reset()
    })
}
</script>

<template>
    <Head title="Criar Perfil" />
    <AppLayout>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-6">Criar Novo Perfil</h1>

        <form @submit.prevent="submit" class="space-y-4 max-w-md">
            <div>
                <Label for="name">Nome do Perfil</Label>
                <Input id="name" v-model="form.name" type="text" required />
                <p v-if="form.errors.name" class="text-red-500 text-sm">{{ form.errors.name }}</p>
            </div>

            <Button type="submit" :disabled="form.processing">Criar Perfil</Button>
        </form>
    </div>
    </AppLayout>
</template>
