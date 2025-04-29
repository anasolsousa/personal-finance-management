<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entity;
use App\Models\SubEntity;

class EntityController extends Controller
{
       // ENTITY
       public function index() 
       {
           $entity = Entity::all();
           return response()->json($entity);
       }
   
       public function store(Request $request)
       {
           $entity = new Entity();
   
           $entity->name = $request->name;
           $entity->icon = $request->icon;
   
           $entity->save();
   
           return response()->json([
               'message' => 'Entidade criada com sucesso',
               'Entity' => $entity
           ], 201);
       }
   
       public function update(Request $request, string $id)
       {
           $entity = Entity::find($id);
   
           if(!$entity){
               return response()->json([
                   'message' => 'Entidade não foi encontrada'
               ], 404);
           }
   
           $validated = $request->validate([
               'name' => 'required|unique:entities,name,'. $entity->id,
               'icon' => 'required|max:255',
           ], [
               'name.unique' => 'Este nome já está inserido. Por favor escolha outro.',
               'icon.max' => 'O campo icon aceita no máximo 255 caracteres.'
           ]);
   
           $entity->update($validated);
   
           return response()->json([
               'message' => 'Entidade atualizado com sucesso',
               'entity' => $entity 
           ], 200);
       }
   
       /**
        * Remove the specified resource from storage.
        */
       public function destroy(string $id)
       {
           $entity = Entity::where('id', $id);
   
           if(!$entity){
               return response()->json([
                   'message' => 'Entidade não foi encontrada'
               ], 400);
           }
   
           $entity->delete();
   
           return response()->json([
               'message' => 'Entidade eliminada com sucesso'
           ]);
       }
   
       // SUBENTITY
   
       public function indexSubEntity() 
       {
           $subEntity = SubEntity::with('entity')->get(); // para aparecer o icon no front falatava esta parte
           return response()->json($subEntity);
       }
   
       public function storeSubEntity(Request $request)
       {
           $subEntity = new SubEntity();
   
           $subEntity->name = $request->name;
           $subEntity->entity_id = $request->entity_id;
           
           $subEntity->save();
   
           return response()->json([
               'message' => 'Sub-entidade criada com sucesso',
               'Entity' => $subEntity
           ], 201);
       }
   
       public function updateSubEntity(Request $request, string $id)
       {
           $subEntity = SubEntity::find($id);
   
           if(!$subEntity){
               return response()->json([
                   'message' => 'Entidade não foi encontrada'
               ], 404);
           }
   
           $validated = $request->validate([
               'name' => 'required|unique:sub_entities,name,'. $subEntity->id,
               'entity_id' => 'required|max:255',
           ], [
               'name.unique' => 'Este nome já está inserido. Por favor escolha outro.',
               'entity_id.max' => 'O campo aceita no máximo 255 caracteres.'
           ]);
   
           $subEntity->update($validated);
   
           return response()->json([
               'message' => 'Sub-entidade atualizada com sucesso',
               'subEntity' => $subEntity 
           ], 200);
       }
   
       /**
        * Remove the specified resource from storage.
        */
       public function destroySubEntity(string $id)
       {
           $subEntity = SubEntity::where('id', $id);
   
           if(!$subEntity){
               return response()->json([
                   'message' => 'Entidade não foi encontrada'
               ], 400);
           }
   
           $subEntity->delete();
   
           return response()->json([
               'message' => 'Sub-Entidade eliminada com sucesso'
           ]);
       }
   
   
   
       public function entityAndSubEntity()
       {
           $subEntities = SubEntity::with('entity')
           ->get()
           ->groupBy('entity_id')
           ->map(function ($group) {
               return [
                   'entity' => $group->first()->entity->name,
                   'SubEntity' => $group
               ];
           });
   
           return response()->json($subEntities);
       }
}
