<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Filters\V1\TicketFilter;
use App\Http\Requests\Api\V1\ReplaceTicketRequest;
use App\Http\Requests\Api\V1\StoreTicketRequest;
use App\Http\Requests\Api\V1\UpdateTicketRequest;
use App\Http\Resources\V1\TicketResource;
use App\Models\Ticket;
use App\Traits\ApiResponses;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Api\V1\ApiController;

class AuthorTicketsController extends ApiController
{
    use ApiResponses;

    public function index($author_id, TicketFilter $filters)
    {
        return TicketResource::collection(
            Ticket::where('user_id', $author_id)->filter($filters)->paginate()
        );
    }

    public function store($author_id, StoreTicketRequest $request)
    {
        return new TicketResource(Ticket::create($request->mappedAttributes([
            'user_id' => $author_id,
        ])));
    }

    public function replace(ReplaceTicketRequest $request, $author_id, $ticket_id)
    {

        try {
            $ticket = Ticket::findOrFail($ticket_id);

            if ($ticket->user_id == $author_id) {

                $ticket->update($request->mappedAttributes());

                return new TicketResource($ticket);
            }

        } catch (ModelNotFoundException $exception) {
            return $this->error('The ticket id is invalid', 404);
        }
    }

    public function update(UpdateTicketRequest $request, $author_id, $ticket_id)
    {

        try {
            $ticket = Ticket::findOrFail($ticket_id);

            if ($ticket->user_id == $author_id) {

                $ticket->update($request->mappedAttributes());

                return new TicketResource($ticket);
            }

        } catch (ModelNotFoundException $exception) {
            return $this->error('The ticket id is invalid', 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($author_id, $ticket_id)
    {
        //
        try {
            $ticket = Ticket::findOrFail($ticket_id);
            if ($ticket->user_id == $author_id) {
                $ticket->delete();

                return $this->ok('The ticket has been deleted successfully');
            }

            return $this->error('The ticket id is invalid', 404);

        } catch (ModelNotFoundException $exception) {
            //     return response()->json([
            //     'message' => 'The ticket id is invalid'
            // ], 404);
            return $this->error('The ticket id is invalid', 404);
        }
    }
}
