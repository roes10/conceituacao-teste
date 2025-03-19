<script setup>
import { Button } from '@/components/ui/button';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    roles: Object,
});

const form = useForm({});

const deleteRole = (id) => {
    if (confirm('Tem certeza que deseja excluir este perfil?')) {
        form.delete(route('roles.destroy', id), {
            preserveScroll: true,
            onSuccess: () => form.reset(),
        });
    }
};
</script>

<template>
    <Head title="Gerenciar Perfis" />
    <AppLayout>
        <div class="p-6">
            <div class="mb-6 flex items-center justify-between">
                <h1 class="text-2xl font-bold">Perfis</h1>
                <Link :href="route('roles.create')">
                    <Button>Novo Perfil</Button>
                </Link>
            </div>

            <Table>
                <TableHeader>
                    <TableRow>
                        <TableHead>ID</TableHead>
                        <TableHead>Nome</TableHead>
                        <TableHead>Ações</TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-for="role in roles.data" :key="role.id">
                        <TableCell>{{ role.id }}</TableCell>
                        <TableCell>{{ role.name }}</TableCell>
                        <TableCell>
                            <Link :href="route('roles.edit', role.id)">
                                <Button variant="outline" size="sm" class="mr-2">Editar</Button>
                            </Link>
                            <Button variant="destructive" size="sm" @click="deleteRole(role.id)">Excluir</Button>
                        </TableCell>
                    </TableRow>
                </TableBody>
            </Table>

            <div class="mt-4 flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-700">Mostrando {{ roles.from }} a {{ roles.to }} de {{ roles.total }} perfis</p>
                </div>
                <div class="flex gap-2">
                    <Link :href="roles.prev_page_url" :disabled="!roles.prev_page_url">
                        <Button variant="outline" :disabled="!roles.prev_page_url">Anterior</Button>
                    </Link>
                    <Link :href="roles.next_page_url" :disabled="!roles.next_page_url">
                        <Button variant="outline" :disabled="!roles.next_page_url">Próximo</Button>
                    </Link>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
