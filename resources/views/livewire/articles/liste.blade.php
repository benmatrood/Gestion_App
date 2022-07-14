<div class="row p-4 pt-5 ">
    <div class="col-12">
        <div class="card" style="height: 75vh;">
            <div class="card-header " style="background-color: #4c1661;color: #fff; font-weight: 900;">
                <h3 class="card-title"> <i class="fas fa-users fa-2x"></i> Listes des articles</h3>
                <div class="card-tools d-flex align-items-center" >
                    <a href="#" class="btn btn-link text-white mr-4 d-block" style="color: #fff;" wire:click.prevent="go_to_add_user()">
                        <i class="fas fa-user-plus icon" ></i>
                        Ajouter articles</a>
                    <div class="input-group input-group-sm" style="width: 200px;">
                        <input type="text" name="table_search" class="form-control float-right"
                            placeholder="Recherche..." wire:model.debounce.250ms="search">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive p-0 table-striped" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th style="width:2%"></th>
                            <th >Libélé</th>
                            <th >Référence</th>
                            <th style="width:10%" >Description</th>
                            <th >Stock</th>
                            <th class="text-center">Groupe</th>
                            <th class="text-center">Famille</th>
                            <th class="text-center">Sous Famille</th>
                            <th class="text-center">Palier Privilège</th>
                            <th  class="text-center">Date d'ajout</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($articles as $article)
                        <tr>
                            <td>
                                @if($article->url_image !="")
                                {{-- <img src="{{$article->url_image}}" alt="user"  width="35px">
                                 --}}
                                 <img src="{{asset('storage/app/url_image/83tdlovWma6h1EKIDaH4xeYFq72ZbrmC9T9bHJ4l.png')}}" alt="user"  width="35px">
                                @else
                                <img src="{{asset('storage/app/livewire-tmp/0kOklRLWlr89dxxgEWehel0yBm0hwc-metaQ2FwdHVyZS5QTkc=-.png')}}" alt="user"  width="35px">
                                @endif
                            </td>
                            <td>{{$article->nom_article}}</td>
                            <td>{{Str::of($article->reference_article)->limit(30)}}</td>
                            
                            <td >{{Str::of($article->despription)->limit(30)}}</td>
                            <td class="text-center">{{$article->stock}}</td>
                            <td>{{$article->r_article_groupe->nom_groupe}}</td>
                            <td class="text-center">{{$article->r_article_famille->nom_famille}}</td>
                            <td class="text-center">{{$article->r_article_sousfamille->nom_sousfamille}}</td>
                            <td class="text-center">{{$article->r_article_palierprivilege->nom_palierprivilege}}</td>
                            
                            <td class="text-center"><span
                                    class="tag tag-success">{{$article->created_at->diffForHumans()}}</span></td>
                            <td class="text-center">
                                <button class="btn btn-link" wire:click ="go_to_edit_article({{$article->id}})"><i class="far fa-edit"></i></button>
                                <button class="btn btn-link" wire:click="confim_delete('{{$article->nom_article}}',{{$article->id}})"><i
                                        class="fas fa-trash-alt" style="color:red ;"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
</div>
