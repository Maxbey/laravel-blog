<?php namespace App\Repositories\KeysRepository;


use Redis;

class KeysRepository implements IKeysRepository
{
    /**
     * Return array of all keys.
     * @return array
     */
    public function all()
    {
        $keys = Redis::get('invitation_keys');

        if(!$keys)
        {
            return [];
        }

        return json_decode($keys);
    }

    /**
     * It checks whether there is the key to the storage.
     * @param $key
     * @return bool
     */
    public function exists($key)
    {
        $keys = $this->all();

        return in_array($key, $keys);
    }

    /**
     * Create a new one key.
     * @param $key
     * @return bool
     */
    public function create($key)
    {
        $keys = $this->all();
        $keys[] = $key;

        return $this->save($keys);
    }

    /**
     * Save array to the storage.
     * @param array $keys
     * @return bool
     */
    public function save(array $keys)
    {
        return Redis::set('invitation_keys', json_encode($keys));
    }


    /**
     * Remove the given key from the storage
     * @param $key
     * @return bool
     */
    public function delete($key)
    {
        $keys = $this->all();

        $callback = function($value) use($key) {
            if ($value === $key)
            {
                unset($value);
            }
        };

        array_map($callback, $keys);

        return $this->save($keys);
    }
}