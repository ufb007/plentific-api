<?php

namespace Ubozdemir\Plentific\DTOs;

use JsonSerializable;

readonly class UserDTO implements JsonSerializable
{
    /**
     * Constructor for creating a new instance of the class.
     *
     * @param int $id 
     * @param string $first_name 
     * @param string $last_name 
     * @param string $email 
     * @param string $avatar 
     */
    public function __construct(
        public int $id,
        public string $first_name,
        public string $last_name, 
        public string $email, 
        public string $avatar
    ) {}

    /**
     * Json Serialize
     *
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    /**
     * Convert the object to an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'full_name' => $this->first_name . ' ' . $this->last_name,
            'email' => $this->email,
            'avatar' => $this->avatar
        ];
    }
}
