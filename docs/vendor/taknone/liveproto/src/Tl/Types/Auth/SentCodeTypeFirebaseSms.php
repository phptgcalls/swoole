<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Auth;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int length bytes nonce long play_integrity_project_id bytes play_integrity_nonce string receipt int push_timeout
 * @return auth.SentCodeType
 */

final class SentCodeTypeFirebaseSms extends Instance {
	public function request(int $length,? string $nonce = null,? int $play_integrity_project_id = null,? string $play_integrity_nonce = null,? string $receipt = null,? int $push_timeout = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x9fd736);
		$flags = 0;
		$flags |= is_null($nonce) ? 0 : (1 << 0);
		$flags |= is_null($play_integrity_project_id) ? 0 : (1 << 2);
		$flags |= is_null($play_integrity_nonce) ? 0 : (1 << 2);
		$flags |= is_null($receipt) ? 0 : (1 << 1);
		$flags |= is_null($push_timeout) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		if(is_null($nonce) === false):
			$writer->tgwriteBytes($nonce);
		endif;
		if(is_null($play_integrity_project_id) === false):
			$writer->writeLong($play_integrity_project_id);
		endif;
		if(is_null($play_integrity_nonce) === false):
			$writer->tgwriteBytes($play_integrity_nonce);
		endif;
		if(is_null($receipt) === false):
			$writer->tgwriteBytes($receipt);
		endif;
		if(is_null($push_timeout) === false):
			$writer->writeInt($push_timeout);
		endif;
		$writer->writeInt($length);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['nonce'] = $reader->tgreadBytes();
		else:
			$result['nonce'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['play_integrity_project_id'] = $reader->readLong();
		else:
			$result['play_integrity_project_id'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['play_integrity_nonce'] = $reader->tgreadBytes();
		else:
			$result['play_integrity_nonce'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['receipt'] = $reader->tgreadBytes();
		else:
			$result['receipt'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['push_timeout'] = $reader->readInt();
		else:
			$result['push_timeout'] = null;
		endif;
		$result['length'] = $reader->readInt();
		return new self($result);
	}
}

?>