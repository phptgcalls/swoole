# Client Class

## methods

- `__construct` => <kbd>void</kbd> : Initializes the Telegram client
  - <kbd>string | null $resourceName</kbd> , the saved session identifier ( or `null` for a new session which is not going to be saved )
  - <kbd>string | null $storageDriver</kbd> , the operation mode (e.g. `"mysql"`, `"string"`, `"text"`) or `null`
  - <kbd>Settings $settings</kbd> , an instance of configuration settings

- `connect` => <kbd>void</kbd> : Establishes a TCP connection to the current data center

  - <kbd>bool $reconnect = false</kbd> , whether to force a reconnection if already connected
  - <kbd>bool $reset = false</kbd> , whether to reset authorization on reconnect

- `setDC` => <kbd>void</kbd> : Sets the IP, port and identifier for a data center

  - <kbd>string $ip</kbd> , the DC’s IPv4 or IPv6 address
  - <kbd>int $port</kbd> , the TCP port number
  - <kbd>int $id</kbd> , the DC’s numeric identifier

- `changeDC` => <kbd>void</kbd> : Immediately switches to a different data center

  - <kbd>int $dcid</kbd> , the target data center ID

- `switchDC` => <kbd>self</kbd> : Prepares switching to another DC, with flags

  - <kbd>? int $dcid = null</kbd> , target DC ID (omit to cycle)
  - <kbd>bool $cdn = false</kbd> , whether to prefer a CDN endpoint
  - <kbd>bool $media = false</kbd> , whether this is for a media connection
  - <kbd>bool $next = false</kbd> , whether to move to the “next” DC in list
  - <kbd>int $expires_in = 0</kbd> , time ( in seconds ) for temporary auth

- `getTemp` => <kbd>self</kbd> : Retrieves a temporary auth client

  - <kbd>int $expires_in</kbd> , TTL ( in seconds ) of the temporary auth settings

- `checkAuthorization` => <kbd>bool</kbd> : Checks if the client is authorized on a DC

  - <kbd>int $dcid</kbd> , the DC ID to verify

- `getAuthorizations` => <kbd>array</kbd> : Returns all active authorizations

  - <kbd>mixed | array $filters</kbd> , optional filter(s) to restrict results

- `isAuthorized` => <kbd>bool</kbd> : Returns whether the client is currently authorized ( `Authentication::LOGIN` )

- `getStep` => <kbd>Authentication</kbd> : Returns the current [authentication step](en/enums.md#Authentication) enum

- `removeDC` => <kbd>void</kbd> : Deleting clients associated with an IP

  - <kbd>string $ip</kbd> , the IP address

- `layer` => <kbd>int</kbd> : Returns the MTProto layer number

  - <kbd>bool $secret = false</kbd> , whether to return the “secret chat” layer

- `registerFilteredFunctions` => <kbd>void</kbd> : Registers internal RPC functions for filtered updates

- `addHandler` => <kbd>void</kbd> : Adds an update‐handler callback

  - <kbd>object | callable $callback</kbd> , the handler to invoke on incoming updates
  - <kbd>? string $unique = null</kbd> , an optional key to identify this handler
  - <kbd>Filter | array | null $filters</kbd> , update‐filter(s) to apply

- `removeHandler` => <kbd>void</kbd> : Removes a previously added handler

  - <kbd>object | callable $callback</kbd> , the handler to remove
  - <kbd>? string $unique = null</kbd> , the unique key ( if one was provided )

- `fetchUpdate` => <kbd>object</kbd> : Fetches and returns an raw update

  - <kbd>array $updates</kbd> , an array to populate with received updates
  - <kbd>? callable $callback = null</kbd> , a callback to accept or reject updates
  - <kbd>float $timeout = 0</kbd> , seconds to wait for updates ( 0 = We will wait until the update is received )

- `start` => <kbd>void</kbd> : Starts the automatic update loop ( long polling )

- `stop` => <kbd>void</kbd> : Stops the automatic update loop

- `disconnect` => <kbd>void</kbd> : Gracefully closes the TCP connection