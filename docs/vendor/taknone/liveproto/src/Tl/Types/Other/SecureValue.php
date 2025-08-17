<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param securevaluetype type bytes hash securedata data securefile front_side securefile reverse_side securefile selfie Vector<SecureFile> translation Vector<SecureFile> files secureplaindata plain_data
 * @return SecureValue
 */

final class SecureValue extends Instance {
	public function request(object $type,string $hash,? object $data = null,? object $front_side = null,? object $reverse_side = null,? object $selfie = null,? array $translation = null,? array $files = null,? object $plain_data = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x187fa0ca);
		$flags = 0;
		$flags |= is_null($data) ? 0 : (1 << 0);
		$flags |= is_null($front_side) ? 0 : (1 << 1);
		$flags |= is_null($reverse_side) ? 0 : (1 << 2);
		$flags |= is_null($selfie) ? 0 : (1 << 3);
		$flags |= is_null($translation) ? 0 : (1 << 6);
		$flags |= is_null($files) ? 0 : (1 << 4);
		$flags |= is_null($plain_data) ? 0 : (1 << 5);
		$writer->writeInt($flags);
		$writer->write($type->read());
		if(is_null($data) === false):
			$writer->write($data->read());
		endif;
		if(is_null($front_side) === false):
			$writer->write($front_side->read());
		endif;
		if(is_null($reverse_side) === false):
			$writer->write($reverse_side->read());
		endif;
		if(is_null($selfie) === false):
			$writer->write($selfie->read());
		endif;
		if(is_null($translation) === false):
			$writer->tgwriteVector($translation,'SecureFile');
		endif;
		if(is_null($files) === false):
			$writer->tgwriteVector($files,'SecureFile');
		endif;
		if(is_null($plain_data) === false):
			$writer->write($plain_data->read());
		endif;
		$writer->tgwriteBytes($hash);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['type'] = $reader->tgreadObject();
		if($flags & (1 << 0)):
			$result['data'] = $reader->tgreadObject();
		else:
			$result['data'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['front_side'] = $reader->tgreadObject();
		else:
			$result['front_side'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['reverse_side'] = $reader->tgreadObject();
		else:
			$result['reverse_side'] = null;
		endif;
		if($flags & (1 << 3)):
			$result['selfie'] = $reader->tgreadObject();
		else:
			$result['selfie'] = null;
		endif;
		if($flags & (1 << 6)):
			$result['translation'] = $reader->tgreadVector('SecureFile');
		else:
			$result['translation'] = null;
		endif;
		if($flags & (1 << 4)):
			$result['files'] = $reader->tgreadVector('SecureFile');
		else:
			$result['files'] = null;
		endif;
		if($flags & (1 << 5)):
			$result['plain_data'] = $reader->tgreadObject();
		else:
			$result['plain_data'] = null;
		endif;
		$result['hash'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>