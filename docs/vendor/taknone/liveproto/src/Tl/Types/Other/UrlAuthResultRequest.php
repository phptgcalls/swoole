<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param user bot string domain true request_write_access
 * @return UrlAuthResult
 */

final class UrlAuthResultRequest extends Instance {
	public function request(object $bot,string $domain,? true $request_write_access = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x92d33a0e);
		$flags = 0;
		$flags |= is_null($request_write_access) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($bot->read());
		$writer->tgwriteBytes($domain);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['request_write_access'] = true;
		else:
			$result['request_write_access'] = false;
		endif;
		$result['bot'] = $reader->tgreadObject();
		$result['domain'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>