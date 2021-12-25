<?php


namespace App\Packages\Shared\Service;


use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;

class SearchData
{
    private $currentPage;
    private $entities;
    private $searchResultTotalCount;
    private $perPage;
    private $params;

    protected $names;
    protected $rules;

    public function __construct(array $params)
    {
        $this->validation($params);
        $this->params = $params;
        $this->perPage = config('setting.pagination.per_page');
        $this->currentPage = Paginator::resolveCurrentPage();
    }

    protected function validation($params)
    {
        $validator = Validator::make($params, $this->rules, [], $this->names);
        if ($validator->fails()) {
            foreach ($validator->errors()->getMessages() as $key => $message) {
                //配列用に.以前を取得
                $key = explode('.',$key)[0];
                $errorMessages[] = [
                    "field" => $key,
                    "name" => $this->names[$key],
                    "message" => $message[0]
                ];
            }
            throw new HttpResponseException(
                response()->json([
                    'message' => 'Validation Error',
                    'errors' => $errorMessages
                ],Response::HTTP_BAD_REQUEST)
            );
        }
    }

    public function setEntities($entities) {
        $this->entities = $entities;
    }

    public function setSearchResultTotalCount($number) {
        $this->searchResultTotalCount = $number;
    }

    /**
     * @return mixed
     */
    public function getEntities()
    {
        return $this->entities;
    }

    /**
     * @return mixed
     */
    public function getSearchResultTotalCount()
    {
        return $this->searchResultTotalCount;
    }

    public function getHeadId() {
        return ($this->getCurrentPage()-1) * $this->getPerPage();
    }

    /**
     * @return int
     */
    public function getPerPage() {
        return $this->perPage;
    }

    /**
     * @return int
     */
    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }
}
