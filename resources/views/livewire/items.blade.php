

<div class="p-6 sm:px-20 bg-white border-b border-gray-1000">

    <div class="mt-8 text-2x1 flex justify-between">
<div class="">
            <input wire:model.debounce.500ms="q" type="search" placeholder="Search" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />            </div>         <div class="mr-2">
            <x-jet-button wire:click="confirmItemAdd" class="bg-blue-500 hover:bg:blue-700">
            Add New Item
            </x-jet-button>
        </div>

    </div>



<div class="card mt-5">
        


    <div class="mt-6">
        <div class="flex justify-between">
            <div></div>
            
            <div class="mr-2">
                <input type="checkbox" class="mr-6 leading-tight" wire:model="active" />    Active Only?
            </div>
        </div>
        <table class ="table-auto w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2">
                        <div class="flex items-center">
                            ID<button wire:click="sortBy('id')"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
</svg>
</button>
                        </div>

                    </th>
                    <th class="px-4 py-2">
                        <div class="flex item-center">
                        Name<button wire:click="sortBy('name')"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"> <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                            </svg>
                            </button>
                                
                        </div>
                    </th>


                    <th class="px-4 py-2">
                        <div class="flex item-center">
                        Price<button wire:click="sortBy('price')"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
</svg>
</button>
                        </div>
                    </th>
                    @if(!$active)
                        <th class="px-4 py-2">
                        <div class="flex item-center">
                            Status</div>
                        </th>
                    @endif
                    <th class="px-8 py-2">
                    <div class="flex item-center">

                    Action
</div>
                    </th>
                </tr>
            </thead>

            <tbody>
                @foreach($items as $item)
                    <tr>
                            <td class="boder px-4 py-2 ">{{$item->id}}</td>
                            <td class="boder px-4 py-2">{{$item->name}}</td>
                            <td class="boder px-4 py-2">{{number_format($item->price,2)}}</td>
                            @if(!$active)
                                 <td class="boder px-4 py-2">{{$item->status? 'Active' : 'Not-Active'}}</td>
                            @endif
                            <td class="boder px-30 py-2">
                            <x-jet-button wire:click="confirmItemEdit({{$item->id}})" class="bg-orange-500 hover:bg-orange-700">
                                Edit
                                </x-jet-button>
                                <x-jet-danger-button wire:click="confirmItemDeletion({{$item->id}})" wire:loading.attr="disabled">
                                    Delete</x-jet-danger-button>

                            </td>
                    <tr>
                    
                @endforeach
            </tbody>
        </table>
    </div>
    <br>
    <div class="mt-4">
{{$items->links()}} 
</div>



<x-jet-dialog-modal wire:model="confirmItemDeletion">
            <x-slot name="title">
                {{ __('Delete Item') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Are you sure you want to delete Item?') }}
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$set('confirmItemDeletion',false)" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-2" wire:click="deleteItem({{$confirmItemDeletion}})" wire:loading.attr="disabled">
                    {{ __('Delete') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>
       <!-- add -->

        <x-jet-dialog-modal wire:model="confirmItemAdd">
            <x-slot name="title">
                {{ isset($this->item->id)?'Edit Item' : 'Add Item'}}
            </x-slot>

            <x-slot name="content">
            <div class="col-span-6 sm:col-span-4 mt-4">
            <x-jet-label for="name" value="{{ __('Name') }}" />
            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="item.name" />
            <x-jet-input-error for="item.name" class="mt-2" />
        </div>     
        
        <div class="col-span-6 sm:col-span-4 mt-4">
            <x-jet-label for="price" value="{{ __('Price') }}" />
            <x-jet-input id="price" type="text" class="mt-1 block w-full" wire:model.defer="item.price" />
            <x-jet-input-error for="item.price" class="mt-2" />   
</div>

        <div class="col-span-6 sm:col-span-4 mt-4">
            <label class="flex items-center">
                <input type="checkbox" wire:model.defer="item.status" class="form-checkbox"/>
                <sapn class= "ml-2 text-sm text-gray-600"> Active</span>
        </div>    
    </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$set('confirmItemAdd',false)" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-2" wire:click="saveItem()" wire:loading.attr="disabled">
                    {{ __('Save') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>



</div>
